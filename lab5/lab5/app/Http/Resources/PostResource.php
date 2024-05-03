<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PharIo\Manifest\Author;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id'=>$this->id,
        'title'=>$this->title ,
        'body'=>$this->body,
        'image'=>"/images/posts/{$this->image}",
        'author'=>$this->author,
        'Author-data'=>new AuthorResource($this->Author)
          ## display relation in the resource
        // 'author_name'=> $this->author ? $this->Author->name: 'no author',
        //  # I need to return with creator_id ,name
        // 'author_object'=>$this->author ? $this->Author : "no author",
        // 'author_obj'=> $this->author? new AuthorResource($this->author) : null
      ];
    }
}

