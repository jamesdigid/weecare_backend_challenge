<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
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
            'itunes_id' => $this->itunes_id, 
            'name' => $this->name, 
            'title' => $this->title, 
            'artist_label' => $this->artist_label, 
            'artist_href' => $this->artist_href, 
            'item_count' => $this->item_count,
            'price' => $this->price,
            'rights' => $this->rights,
            'link' => $this->link,
            'content_type' => $this->contentType,
            'category' => $this->category,
            'albumImages' => $this->albumImages
        ];
    }
}
