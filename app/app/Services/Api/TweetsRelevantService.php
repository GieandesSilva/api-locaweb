<?php


namespace App\Services\Api;

use App\Models\TweetsRelevant;


class TweetsRelevantService
{

    protected $model;
    protected $tweetsRelevant;

    /**
     * TweetsRelevant constructor.
     * @param TweetsRelevant $model
     */
    public function __construct(TweetsRelevant $model)
    {
        $this->model = $model;
    }

    public function execute()
    {
         $this->tweetsRelevant = array (
            'followers_count' => 840,
            'screen_name' => "vandervort_raven_i",
            'profile_link' => "https://twitter.com/vandervort_raven_i",
            'created_at' => "Mon Sep 24 03:35:21 +0000 2012",
            'link' => "https://twitter.com/vandervort_raven_i/status/812382",
            'retweet_count' => 0 ,
            'text' => "We need to naviga @locaweb",
            'favorite_count' => 175
        );

        return $this->tweetsRelevant;
    }
}
