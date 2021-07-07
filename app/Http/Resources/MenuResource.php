<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'photo'=> $this->photo,
            'price'=> $this->price,
            'type'=> $this->type,
            'detail'=> $this->detail,
            'status'=> $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        
        ];
    }
    
}
