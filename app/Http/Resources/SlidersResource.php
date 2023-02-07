<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->is_ad) {
            return [
                'id_ad' => $this->is_ad,
                'content' => $this->content,
            ];
        } else {
            return [
                'id_ad' => $this->is_ad,
                'content' => $this->content,
                'see_more' => $this->see_more,
                'media' => $this->getFirstMediaUrl(),
            ];
        }
    }
}
