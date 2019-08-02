<?php

namespace Tests\Unit;

use Tests\TestCase;

class SortedByTest extends TestCase
{

    protected $token;
    protected $followersOld = INF;
    protected $retweetOld = INF;
    protected $favoriteOld = INF;


    public function testTweetsSortedBySpecificFields()
    {

        $body = [
            "grant_type" => "password",
            "client_id" => env("API_AUTH_CLIENT_ID"),
            "client_secret" => env("API_AUTH_CLIENT_SECRET"),
            "username" => env("API_AUTH_USERNAME"),
            "password" => env("API_AUTH_PASSWORD"),
            "scope" => "*"
        ];

        $response = $this->json('POST', '/oauth/token', $body);
        $response->assertStatus(200);
        $data = json_decode($response->getContent());
        $this->token = $data->access_token;

        $headers = [
            'Authorization' => 'Bearer ' . $this->token
        ];

        $response = $this->json('GET', '/api/most_relevant', [], $headers);
        $response->assertStatus(200);
        $tweets = json_decode($response->getContent());

        foreach ($tweets as $key => $tweet) {

            $this->assertTrue($this->followersOld >= $tweet->followers_count);
            if ($tweet->followers_count == $this->followersOld) {
                $this->assertTrue($tweet->retweet_count <= $this->retweetOld);

                if ($tweet->retweet_count == $this->retweetOld) {
                    $this->assertTrue($tweet->favorite_count <= $this->favoriteOld);
                    $this->favoriteOld = $tweet->favorite_count;
                }
                $this->retweetOld = $tweet->retweet_count;
            }
            $this->followersOld = $tweet->followers_count;
        }
    }
}
