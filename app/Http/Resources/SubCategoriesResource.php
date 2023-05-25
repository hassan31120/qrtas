<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductsResource;

class SubCategoriesResource extends JsonResource
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

        return[
            'id' => $this->id,
            'title' => app()->getLocale() == 'ar' ?  $this->title : $this->title_en,
            'cat_id' => $this->cat_id,
            'products' => ProductsResource::collection($this->products),
            'name' => $this->title,
            'name_en' => $this->title_en,
            'cat' => $this->categories->title
        ];
    }
}
