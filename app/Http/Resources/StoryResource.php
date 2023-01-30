<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->is('api/get-all-stories')) {
            return [
                'id' => $this->id,
                'category_id' => $this->category->name,
                'title' => $this->title,
                'content' => $this->content,
                'media' => $this->getMedia()[0],
            ];
        } elseif ($request->is('api/get-story')) {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'media' => $this->getMedia(),
                'sliders' => SlidersResource::collection($this->sliders)
            ];
        }
    }
}
