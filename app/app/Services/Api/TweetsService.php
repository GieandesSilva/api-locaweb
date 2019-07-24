<?php


namespace App\Services\Api;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class TweetsService
{

    protected $tweetsRelevant;
    protected $client;
    protected $host;
    protected $username;

    public function __construct()
    {
        $this->client = new Client();
        $this->host = env("LOCAWEB_HTTP_HOST");
        $this->username = env('LOCAWEB_HTTP_USERNAME');
    }

    public function execute()
    {
        try {
            $tweets = collect();

            $response = $this->client->get($this->host, [
                'headers'        => ['Username' => $this->username],
            ]);

            $allTweets = json_decode($response->getBody()->getContents());

            foreach ($allTweets->statuses as $tweet) {
                if($tweet->in_reply_to_user_id_str != 42 && (sizeof($tweet->entities->user_mentions) > 0 && $tweet->entities->user_mentions[0]->id == 42)) {
                    $tweets->push($tweet);
                }
            }

            return $tweets->values()->sortByDesc('favorite_count')->sortByDesc('retweet_count')->sortByDesc('user.followers_count');
        }catch (Exception $e) {

             Log::info('[TWEETS][SERVICE]: ' . $e->getMessage());
             abort(502, 'O serviço está indisponível, que chato :(, nossos profissionais estão se dedicando para solucionar');
        }
    }
}
