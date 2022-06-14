<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $product = Product::find($this->id);

        return [
            'productID' => $this->id,
            'Size' => $product->size,
            'price' => $product->price,
            'Name' => $product->product_name,
            'Description' => $this->description,
        ];
    }
}
