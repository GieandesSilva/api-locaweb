<?php


namespace App\Services\Api\Tweets;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class FetchTweets
{

    protected $client;
    protected $host;
    protected $username;
    protected $tweets;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->host = env("LOCAWEB_HTTP_HOST");
        $this->username = env('LOCAWEB_HTTP_USERNAME');
    }

    public function execute()
    {
        try {
            $response = $this->client->get($this->host, [
                'headers'        => ['Username' => $this->username],
            ]);

            $this->tweets = json_decode($response->getBody()->getContents());

            return collect($this->tweets->statuses);
        }catch (Exception $e) {
             Log::info('[TWEETS][SERVICE]: ' . $e->getMessage());
             abort(502, 'O serviço está indisponível, que chato :(, nossos profissionais estão se dedicando para solucionar');
             return false;
        }
    }
}
