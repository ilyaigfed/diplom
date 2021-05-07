<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackLike extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = null;
}
