<?php

namespace App\Http\Controllers\Search;

use App\Http\Resources\Playlist\PlaylistsResource;
use App\Http\Resources\Track\TracksResource;
use App\Http\Resources\User\ProfilesResource;
use App\Playlist;
use App\Profile;
use App\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if(!$request->q) {
            return [];
        }

        $tracks = Track::search($request->q)->get();
        $profiles = Profile::search($request->q)->get();
        $playlists = Playlist::search($request->q)->get();

        return response()->json([
            'tracks' => new TracksResource($tracks),
            'profiles' => new ProfilesResource($profiles),
            'playlists' => new PlaylistsResource($playlists)
        ]);
    }
}
