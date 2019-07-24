<?php


namespace App\Transformers;


class UsersTransformer
{

    public function transform($tweet)
    {
        return [
            $tweet->user->screen_name => [
                [
                    'screen_name' => $tweet->user->screen_name,
                    'followers_count' => $tweet->user->followers_count,
                    'retweet_count' => $tweet->retweet_count,
                    'favorite_count' => $tweet->favorite_count,
                    'text' => $tweet->text,
                    'created_at' => $tweet->created_at,
                    'profile_link' => 'https://twitter.com/' . $tweet->user->screen_name,
                    'link' => 'https://twitter.com/' . $tweet->user->screen_name . '/status/'. $tweet->id_str
                ]
            ]
        ];
    }
}
