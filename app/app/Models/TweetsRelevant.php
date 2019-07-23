<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TweetsRelevant extends Model
{
    //
    protected $fillable = ['followers_count', 'screen_name', 'profile_link', 'created_at', 'link', 'retweet_count', 'text', 'favorite_count'];
}
