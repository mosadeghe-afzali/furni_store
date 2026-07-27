<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'status_text' => Product::PRODUCT_STATUS_TEXTS[$this->status],
            'created_at' => $this->created_at,

            'variants' => ProductVariantResource::collection($this->whenLoaded('variants')),

            'media' => MediaResource::collection($this->whenLoaded('media')),

        ];
    }
}
