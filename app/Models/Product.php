<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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

    public function scopeFilter($query, array $request)
    {
        $query->when(
            $request['category_id'] ?? false,
            fn($query, $request) => $query->where('category_id', $request)
        );

        $query->when(
            $request['status'] ?? false,
            fn($query, $request) => $query->where('status', $request)
        );
        $query->when(
            $request['max_price'] ?? false,
            fn($query, $minPrice) =>
            $query->whereHas('variants', fn($v) => $v->where('price', '>=', $minPrice))
        );

        $query->when(
            $request['min_price'] ?? false,
            fn($query, $minPrice) =>
            $query->whereHas('variants', fn($v) => $v->where('price', '<=', $maxPrice))
        );
        $query->when(
            $request['name'] ?? false,
            fn($query, $request) => $query->where('name', 'like', "%{$request}%")
        );

        $query->when(
            $request['with_inventory'] ?? false,
            fn($query) =>
            $query->whereHas('variants', fn($v) => $v->where('inventory', '>', 0))
        );
        $query->when(
            $request['with_inventory'] ?? false,
            fn($q, $attributeValues) =>
            collect($attributeValues)->each(
                fn($valueId) =>
                $q->whereHas(
                    'variants.variantAttributeValues',
                    fn($vav) =>
                    $vav->where('attribute_value_id', $valueId)
                )
            )
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
