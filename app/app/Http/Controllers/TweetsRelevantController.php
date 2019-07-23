<?php

namespace App\Http\Controllers;

use App\Services\Api\TweetsRelevantService;
use Illuminate\Support\Facades\Cache;

class TweetsRelevantController extends Controller
{
    protected $service;


    public function __construct(TweetsRelevantService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tweetsRelevants = $this->service->execute();
            return response()->json([$tweetsRelevants]);

//
//            $currentPage = ($request->get('page'))? $request->get('page') : 1;
//            $key = 'users';
//
//            if (!Cache::has($key)) {
//                $users = $this->repository->all();
//                $data = $users->map(function($v) {
//                    return $this->transform->transform($v);
//                });
//
//                Cache::put($key, $data , 1440);
//                return response()->all($key, $data, $this->paginated, $currentPage);
//            }
//
//            return response()->all($key ,Cache::get($key), $this->paginated, $currentPage);
//
        } catch (\Exception $e) {

            return response()->json(['message' => 'Houve um problema, os tweets estão temporiaramente inacessíveis.']);
        }
    }
}
