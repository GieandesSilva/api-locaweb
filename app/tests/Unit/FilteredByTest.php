<?php

namespace Tests\Unit;

use App\Services\Api\Tweets\FilterTweets;
use GuzzleHttp\Client;
use Tests\TestCase;

class FilteredByTest extends TestCase
{

    protected $token;
    protected $followersOld = INF;
    protected $retweetOld = INF;
    protected $favoriteOld = INF;

    public function testTweetsFiltered()
    {

        $client = new Client();
        $response = $client->get(env('LOCAWEB_HTTP_HOST_MOCK'));
        $tweets = json_decode($response->getBody()->getContents());

        $filter = new FilterTweets();

        $tweetsFiltereds = $filter->execute(collect($tweets->statuses));

        foreach ($tweetsFiltereds as $key => $tweet) {

            $this->assertTrue($tweet->in_reply_to_user_id_str != 42);
            $this->assertTrue(sizeof($tweet->entities->user_mentions) > 0);
            $this->assertTrue($tweet->entities->user_mentions[0]->id == 42);
        }
    }
}
