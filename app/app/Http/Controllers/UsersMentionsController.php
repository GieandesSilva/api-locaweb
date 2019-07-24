<?php

namespace App\Http\Controllers;

use App\Services\Api\TweetsService;
use App\Transformers\UsersTransform;
use Exception;
use Illuminate\Http\Response;

class UsersMentionsController extends Controller
{
    protected $service;
    protected $transform;

    public function __construct(TweetsService $service)
    {
        $this->service = $service;
        $this->transform = new UsersTransform();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $tweetsRelevants = collect($this->service->execute());
            $users = $tweetsRelevants->map(function ($v) {
                return $this->transform->transform($v);
            });
            return response()->json($users);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(($e->getCode())? $e->getCode() : 502);
        }
    }
}
