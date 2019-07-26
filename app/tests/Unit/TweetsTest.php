<?php

namespace Tests\Unit;

use Tests\TestCase;

class TweetsTest extends TestCase
{

    protected $token;

    public function testGettingTweets()
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
        $response->assertJsonStructure(
            [
                [
                    'screen_name',
                    'followers_count',
                    'retweet_count',
                    'favorite_count',
                    'text',
                    'created_at',
                    'profile_link',
                    'link'
                ]
            ]
        );
    }
}
