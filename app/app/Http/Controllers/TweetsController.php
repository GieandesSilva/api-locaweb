<?php

namespace App\Http\Controllers;

use App\Services\Api\Tweets\ManagerTweets;
use App\Transformers\TweetsTransformer;
use Exception;
use Illuminate\Http\Response;

class TweetsController extends Controller
{
    protected $service;
    protected $transform;

    public function __construct(ManagerTweets $service)
    {
        $this->service = $service;
        $this->transform = new TweetsTransformer();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {

            $tweetsRelevant = $this->service->execute();

            $tweets = $tweetsRelevant->map(function ($v) {
                return $this->transform->transform($v);
            });

            return response()->json($tweets->values()->all());
        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()])->setStatusCode(($e->getCode())? $e->getCode() : 502);
        }
    }
}
