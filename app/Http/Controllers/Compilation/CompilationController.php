<?php

namespace App\Http\Controllers\Compilation;

use App\Http\Resources\Playlist\PlaylistsResource;
use App\Http\Resources\Track\TracksResource;
use App\Http\Resources\User\ProfilesFromUserResource;
use App\Http\Resources\User\ProfilesResource;
use App\Playlist;
use App\Profile;
use App\Track;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompilationController extends Controller
{
    public function getTen()
    {
        $tracks = Track::whereNull('playlist_id')->orderBy('created_at', 'desc')->take(36)->get();

        return new TracksResource($tracks);
    }

    public function getWinners()
    {
        $users = User::withCount('followers')->orderByDesc('followers_count')->take(10)->get();

        return new ProfilesFromUserResource($users);
    }

    public function getParty()
    {
        $playlists = Playlist::whereHas('genre', function($q) {
            $q->where('name', 'Электро');
            $q->orWhere('name', 'Дип-хаус');
            $q->orWhere('name', 'Хаус');
        })
            ->where(function($sub_query) {
                $sub_query->whereHas('playlist_type', function($q) {
                    $q->where('name', 'Лайв');
                    $q->orWhere('name', 'Плейлист');
                    $q->orWhere('name', 'Подборка');
                    $q->orWhere('name', 'Ремиксы');
                });
            })->
        withCount('likes')->orderByDesc('likes_count')->take(10)->get();

        return new PlaylistsResource($playlists);
    }

    public function getClassic()
    {
        $playlists = Playlist::whereHas('genre', function($q) {
            $q->where('name', 'Классическая музыка');
        })
            ->where(function($sub_query) {
                $sub_query->whereHas('playlist_type', function($q) {
                    $q->where('name', 'Лайв');
                    $q->orWhere('name', 'Плейлист');
                    $q->orWhere('name', 'Подборка');
                    $q->orWhere('name', 'Ремиксы');
                });
            })->
            withCount('likes')->orderByDesc('likes_count')->take(10)->get();

        return new PlaylistsResource($playlists);
    }

    public function getHeavy()
    {
        $playlists = Playlist::whereHas('genre', function($q) {
            $q->where('name', 'Метал');
            $q->orWhere('name', 'Рок');
            $q->orWhere('name', 'Альтернативный рок');
        })
            ->where(function($sub_query) {
                $sub_query->whereHas('playlist_type', function($q) {
                    $q->where('name', 'Лайв');
                    $q->orWhere('name', 'Плейлист');
                    $q->orWhere('name', 'Подборка');
                    $q->orWhere('name', 'Ремиксы');
                });
            })->
            withCount('likes')->orderByDesc('likes_count')->take(10)->get();

        return new PlaylistsResource($playlists);
    }
}
