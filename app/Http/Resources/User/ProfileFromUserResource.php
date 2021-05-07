<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileFromUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $_this = $this->profile;
        $followers = $this->followers()->count();

        return [
            'name' => $_this->name,
            'link' => $_this->link,
            'image' => $_this->image,
            'followers_count' => $followers
        ];
    }
}
