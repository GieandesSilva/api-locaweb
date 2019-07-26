<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{

    protected $token;

    public function testErrorLoginApi()
    {

        $response = $this->json('POST', '/oauth/token');
        $response->assertStatus(400);
        $response->assertJson(['message' => "The authorization grant type is not supported by the authorization server."]);
    }

    public function testLoginApi()
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
        $response->assertJsonStructure(
            [
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token'
            ]
        );
    }
}
