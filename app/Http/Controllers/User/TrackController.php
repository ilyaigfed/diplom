<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\Track\TracksResource;
use App\Track;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
    public function getSeveral(User $user)
    {
        return new TracksResource($user->tracks);
    }

    public function getLiked(User $user)
    {
        $likes = $user->track_likes;

        $ids = [];

        foreach ($likes as $like) {
            $ids[] = $like->track_id;
        }

        $tracks = Track::whereIn('id', $ids)->orderBy('created_at', 'desc')->get();

        return new TracksResource($tracks);
    }
}
