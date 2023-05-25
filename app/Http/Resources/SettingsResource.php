<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'about' => app()->getLocale() == 'ar' ?  $this->about : $this->about_en,
            'contact' => $this->contact,
            'terms' => app()->getLocale() == 'ar' ?  $this->terms : $this->terms_en,
            'privacy' => app()->getLocale() == 'ar' ?  $this->privacy : $this->privacy_en,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'whatsapp' => $this->whatsapp,
            'about_ar' => $this->about,
            'terms_ar' => $this->terms,
            'privacy_ar' => $this->privacy,
            'about_en' => $this->about_en,
            'terms_en' => $this->terms_en,
            'privacy_en' => $this->privacy_en,
        ];
    }
}
