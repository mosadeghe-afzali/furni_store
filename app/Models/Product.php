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

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['category_id'] ?? null, fn ($q, $categoryId) =>
                $q->where('category_id', $categoryId)
            )
            ->when($filters['status'] ?? null, fn ($q, $status) =>
                $q->where('status', $status)
            )
            ->when($filters['name'] ?? null, fn ($q, $name) =>
                $q->where('name', 'like', "%{$name}%")
            )
            ->when($filters['min_price'] ?? null, fn ($q, $minPrice) =>
                $q->whereHas('variants', fn ($v) => $v->where('price', '>=', $minPrice))
            )
            ->when($filters['max_price'] ?? null, fn ($q, $maxPrice) =>
                $q->whereHas('variants', fn ($v) => $v->where('price', '<=', $maxPrice))
            )
            ->when(($filters['in_stock'] ?? null) == '1', fn ($q) =>
                $q->whereHas('variants', fn ($v) => $v->where('inventory', '>', 0))
            )
            ->when($filters['attribute_values'] ?? null, fn ($q, $attributeValues) =>
                collect($attributeValues)->each(fn ($valueId) =>
                    $q->whereHas('variants.varientAttributeValues', fn ($vav) =>
                        $vav->where('attribute_value_id', $valueId)
                    )
                )
            )
            ->when($filters['order_by'] ?? null, function ($q, $orderBy) use ($filters) {
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
