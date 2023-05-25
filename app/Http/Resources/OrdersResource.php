<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
        Carbon::setLocale('ar');

        return [
            'id' => $this->id,
            'name' => $this->users->name,
            'email' => $this->users->email,
            'number' => $this->users->number,
            'total' => (float) $this->total,
            'shipping' => (float) $this->address->cities->price,
            'status' => $this->status,
            'shipment_link' => $this->shipment_link,
            'shipment_id' => $this->shipment_id,
            'image' => asset($this->orderDetails[0]->image),
            'pay_status' => $this->pay_status,
            'grandTotal' => (float) $this->grandTotal,
            'created_at' => $this->created_at->diffForHumans(),
            'dateTime' => $this->created_at,
            'products' => DetailsResource::collection($this->orderDetails),
            'address_name' => $this->address->title,
            'address_desc' => $this->address->description,
            'address_gov' => $this->address->cities->name,
            'address_city' => $this->address->city,
        ];
    }
}
