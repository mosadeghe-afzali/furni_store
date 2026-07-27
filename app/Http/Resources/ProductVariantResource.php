<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
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
            'product_id' => $this->product_id,
            'title' => $this->title,
            'sku' => $this->sku,
            'price' => $this->price,
            'inventory' => $this->inventory,
            'status' => $this->status,

            'attribute_values' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),

            'media' => MediaResource::collection($this->whenLoaded('media')),
        ];
    }
}
