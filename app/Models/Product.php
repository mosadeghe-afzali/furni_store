<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function scopeFilter($query, array $request)
    {
        $query->when(
            $request['category'] ?? false,
            fn($query, $slug) => $query->whereHas('category', fn($q) => $q->where('slug', $slug))
        );

        $query->when(
            $request['status'] ?? false,
            fn($query, $request) => $query->where('status', $request)
        );
        $query->when(
            $request['max_price'] ?? false,
            fn($query, $minPrice) =>
            $query->whereHas('variants', fn($v) => $v->where('price', '<=', $maxPrice))
        );

        $query->when(
            $request['min_price'] ?? false,
            fn($query, $maxPrice) =>
            $query->whereHas('variants', fn($v) => $v->where('price', '>=', $minPrice))
        );
        $query->when(
            $request['name'] ?? false,
            fn($query, $request) => $query->where('name', 'like', "%{$request}%")
        );

        $query->when(array_key_exists('has_inventory', $request), function ($q) use ($request) {
            if ($request['has_inventory'] == 1) {
                $q->whereHas('variants', fn($v) => $v->where('inventory', '>', 0));
            } else {
                $q->whereDoesntHave('variants', fn($v) => $v->where('inventory', '>', 0));
            }
        });

        $query->when(
            $request['color'] ?? false,
            fn($query, $color) =>
            $query->whereHas('variants.variantAttributeValues.attributeValue', function ($q) use ($color) {
                $q->where('attribute_id', 1)->where('value', $color);
            })
        );

        $query->when($request['order_by'] ?? null, function ($q, $orderBy) use ($request) {
            $direction = match (true) {
                str_ends_with($orderBy, '_asc') => 'asc',
                str_ends_with($orderBy, '_desc') => 'desc',
                default => 'desc',
            };

            $column = match (str_replace('_asc', '', str_replace('_desc', '', $orderBy))) {
                'price' => 'min_price',
                'created_at' => 'products.created_at',
                default => 'products.created_at',
            };

            if ($column === 'min_price') {
                $q->withMin('variants', 'price')
                    ->orderBy('variants_min_price', $direction);
            } else {
                $q->orderBy($column, $direction);
            }
        });
    }
}
