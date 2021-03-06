<?php

namespace App\Http\Controllers\User;

use App\Following;
use App\Http\Requests\User\FollowRequest;
use App\Http\Requests\User\GetFollowingsRequest;
use App\Http\Requests\User\UnfollowRequest;
use App\Http\Resources\Track\TracksResource;
use App\Http\Resources\User\FollowingsResource;
use App\Track;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowingController extends Controller
{
    public function getSeveral(User $user)
    {
        return new FollowingsResource($user->followings);
    }

    public function unfollow(User $user, UnfollowRequest $request)
    {
        $me = auth()->user();

        Following::where('owner_id', '=', $user->id)->where('follower_id', '=', $me->id)->forceDelete();

        return response(null, 200);
    }

    public function follow(User $user, FollowRequest $request)
    {
        $me = auth()->user();

        Following::create([
            'owner_id'    => $user->id,
            'follower_id' => $me->id
        ]);

        return response(null, 200);
    }

    public function getNotifications()
    {
        $user = auth()->user();

        $followings = $user->followings;
        $ids = [];

        foreach($followings as $following) {
            $ids[] = $following->owner_id;
        }

        $tracks = Track::whereIn('user_id', $ids)->orderBy('created_at', 'desc')->get();

        return new TracksResource($tracks);
    }
}
