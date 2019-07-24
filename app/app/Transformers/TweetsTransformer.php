<?php


namespace App\Transformers;


class TweetsTransformer
{

    public function transform($tweet) : array
    {
        return [
            'followers_count' => $tweet->user->followers_count,
            'screen_name' => $tweet->user->screen_name,
            'profile_link' => 'https://twitter.com/' . $tweet->user->screen_name,
            'created_at' => $tweet->created_at,
            'link' => 'https://twitter.com/' . $tweet->user->screen_name . '/status/'. $tweet->id_str,
            'retweet_count' => $tweet->retweet_count,
            'text' => $tweet->text,
            'favorite_count' => $tweet->favorite_count
        ];
    }
}
