<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        $result = $this->collection->map(function ($item) {
            $variants = $item->variants ?? collect();

            $colors = $variants->flatMap(fn($v) => $v->attributeValues ?? collect())
                ->where('attribute_id', 1)
                ->pluck('value')
                ->unique()
                ->implode('،');

            return [
                'id' => $item->id,
                'category_id' => $item->category_id,
                'category_slug' => $item->category->slug ?? null,
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'min_price' => $variants->min('price'),
                'max_price' => $variants->max('price'),
                'has_inventory' => $variants->contains('inventory', '>', 0),
                'colors' => $colors,
                'created_at' => $item->created_at,
            ];
        });
        return [
            'data' => $result,
            'meta' => [
                'total'        => $this->total(),
                'count'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages'  => $this->lastPage(),
                'has_more'     => $this->hasMorePages(),
            ],
        ];
    }
}
