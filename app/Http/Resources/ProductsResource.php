<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' =>  app()->getLocale() == 'ar' ?  $this->title : $this->title_en,
            'description' =>  app()->getLocale() == 'ar' ?  $this->description : $this->description_en,
            'images' => ProductImageResource::collection($this->images),
            // 'images' => [
            //     $this->when($this->image, asset($this->image)),
            //     $this->when($this->image2, asset($this->image2)),
            //     $this->when($this->image3, asset($this->image3)),
            //     $this->when($this->image4, asset($this->image4)),
            //     $this->when($this->image5, asset($this->image5))
            // ],
            'allimages' => NewProductImageResource::collection($this->images),
            'amount' => $this->amount,
            'old_price' => (float) $this->old_price ?? null,
            'new_price' => (float) $this->new_price,
            'sub_id' => (int) $this->sub_id,
            'company' => app()->getLocale() == 'ar' ?  $this->subcategories->categories->title : $this->subcategories->categories->title_en,
            'name' => $this->title,
            'name_en' => $this->title_en,
            'desc' => $this->description,
            'desc_en' => $this->description_en,
        ];
    }
}
