<?php

namespace App\Http\Controllers;

use App\Services\Api\Tweets\ManagerTweets;
use App\Transformers\UsersTransformer;
use Exception;
use Illuminate\Http\Response;

class UsersMentionsController extends Controller
{
    protected $service;
    protected $transform;

    public function __construct(ManagerTweets $service)
    {
        $this->service = $service;
        $this->transform = new UsersTransformer();
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

            $users = $tweetsRelevant->map(function ($v) {
                return $this->transform->transform($v);
            });

            return response()->json($users->values()->all());
        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()])->setStatusCode(($e->getCode())? $e->getCode() : 502);
        }
    }
}
