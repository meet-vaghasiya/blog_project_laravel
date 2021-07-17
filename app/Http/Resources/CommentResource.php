<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content'=>$this->content,
            'created_at' =>  (string)($this->created_at),
            // 'user'=> new CommentUserResource($this->user)
            'user'=> new CommentUserResource($this->whenLoaded('user'))
            // 'user'=> $this->user


        ];
    }
}
