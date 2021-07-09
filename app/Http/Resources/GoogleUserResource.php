<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GoogleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email'=> $this->email,
            'email_verified'=> $this->email_verified,
            'name'=> $this->name,
            'picture'=> $this->picture,
            'given_name'=> $this->given_name,
            'family_name'=> $this->family_name,
            'locale'=> $this->locale,        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
