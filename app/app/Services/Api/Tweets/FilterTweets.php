<?php


namespace App\Services\Api\Tweets;

use Illuminate\Support\Collection;


class FilterTweets
{
    protected $tweets;

    public function execute(Collection $tweets) : Collection
    {
        $this->tweets = $tweets->filter(function ($value) {
            return ($value->in_reply_to_user_id_str != 42 && (sizeof($value->entities->user_mentions) > 0 && $value->entities->user_mentions[0]->id == 42));
        });

        return $this->tweets;
    }
}
