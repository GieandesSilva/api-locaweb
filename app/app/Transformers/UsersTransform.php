<?php


namespace App\Transformers;


class UsersTransform
{

    public function transform($tweet) : array
    {
        return [
            $tweet->user->screen_name => [
                [
                    'created_at' => $tweet->created_at,
                    'profile_link' => 'https://twitter.com/' . $tweet->user->screen_name,
                    'favorite_count' => $tweet->favorite_count,
                    'screen_name' => $tweet->user->screen_name,
                    'followers_count' => $tweet->user->followers_count,
                    'link' => 'https://twitter.com/' . $tweet->user->screen_name . '/status/'. $tweet->id_str,
                    'text' => $tweet->text,
                    'retweet_count' => $tweet->retweet_count
                ]
            ]
        ];
    }
}
