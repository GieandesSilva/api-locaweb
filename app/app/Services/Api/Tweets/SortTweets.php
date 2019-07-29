<?php


namespace App\Services\Api\Tweets;

use Illuminate\Support\Collection;


class SortTweets
{
    protected $tweets;

    public function execute(Collection $tweets) : Collection
    {
            $this->tweets = $tweets->values()->sortByDesc('favorite_count')->sortByDesc('retweet_count')->sortByDesc('user.followers_count');
            return $this->tweets;
    }
}
