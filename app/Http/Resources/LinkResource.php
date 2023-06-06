<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'tiktok' => $this->tiktok,
            'snapchat' => $this->snapchat,
            'email' => $this->email,
            'number' => $this->number,
            'whatsapp' => $this->whatsapp,
            'app_store' => $this->app_store,
            'google_play' => $this->google_play,
            'address' => $this->address,
            'logo' => $this->when(true, function () {
                if (isset($this->logo)) {
                    return asset($this->logo);
                } else {
                    return null;
                }
            },)
        ];
    }
}
