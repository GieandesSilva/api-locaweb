<?php


namespace App\Services\Api\Tweets;

use Exception;
use Illuminate\Support\Facades\Log;


class ManagerTweets
{

    protected $client;
    protected $host;
    protected $username;
    protected $tweets;
    private $fetchTweets;
    private $filterTweets;
    private $sortTweets;

    public function __construct(FetchTweets $fetchTweets, FilterTweets $filterTweets, SortTweets $sortTweets)
    {
        $this->filterTweets = $filterTweets;
        $this->sortTweets = $sortTweets;
        $this->fetchTweets = $fetchTweets;
    }

    public function execute()
    {
        try {

            $allTweets = $this->fetchTweets->execute();

            $filteredTweets = $this->filterTweets->execute($allTweets);

            $this->tweets = $this->sortTweets->execute($filteredTweets);

            return $this->tweets;
        }catch (Exception $e) {
             Log::info('[TWEETS][SERVICE]: ' . $e->getMessage());
             abort(502, 'O serviço está indisponível, que chato :(, nossos profissionais estão se dedicando para solucionar');
             return false;
        }
    }
}
