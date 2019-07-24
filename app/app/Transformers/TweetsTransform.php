<?php


namespace App\Transformers;


class TweetsTransform
{

    public function transform($tweet) : array
    {
        return [
            'reply_to' => $tweet->in_reply_to_user_id_str,
            'mention_user' => $tweet->entities->user_mentions[0]->name,
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
