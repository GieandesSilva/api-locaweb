<?php


namespace App\Services\Api;

use App\Models\TweetsRelevant;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class TweetsRelevantService
{

    protected $model;
    protected $tweetsRelevant;
    protected $client;
    protected $host;
    protected $username;

    /**
     * TweetsRelevant constructor.
     * @param TweetsRelevant $model
     */
    public function __construct(TweetsRelevant $model)
    {
        $this->client = new Client();
        $this->model = $model;
        $this->host = env("LOCAWEB_HTTP_HOST");
        $this->username = env('LOCAWEB_HTTP_USERNAME');
    }

    public function execute()
    {
        $tweets = array();
        $response = $this->client->get($this->host, [
            'headers'        => ['Username' => $this->username],
        ]);

        $allTweets = json_decode($response->getBody()->getContents());
        foreach ($allTweets->statuses as $tweet) {
            if($tweet->in_reply_to_user_id_str != 42 && (sizeof($tweet->entities->user_mentions) > 0 && $tweet->entities->user_mentions[0]->id == 42)) {
                $tweet = array (
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
                );
                array_push($tweets, $tweet);
            }
        }

        return $tweets;
    }
}
