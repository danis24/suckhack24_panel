<?php

namespace App\Http\API\V1\Controllers;

use App\Services\Users\UserService;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\Presenters\JsonApiPresenter;

class UserController extends Controller
{
    private $service;

    /**
     * Constructor
     * @param \App\Services\Users\UserService user service
     * @return UserController
     */
    public function __construct(UserService $service) {
        $this->service = $service;
        $this->presenter = new JsonApiPresenter;
    }

    /**
     * Browse Users
     * @return \Illuminate\Http\JsonResponse
     */
    public function browse(){
        $users = $this->service->browse();
        return $this->presenter->renderPaginator($users, 200);
    }

    /**
     * Read user by id
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($id){
        $user = $this->service->read($id);
        return $this->presenter->render($user, 200);
    }

    /**
     * Edit user by id
     * @return \Illuminate\Http\JsonResßponse
     * @param \Illuminate\Http\Request $request
     */
    public function edit($id, Request $request){
        $user = $this->service->edit($id, $request);
        $headers = [
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json'
        ];
        return $this->presenter->render($user, 200, $headers);
    }

    /**
     * Add user
     * @param \Illuminate\Http\Request $request
     */
    public function add(Request $request){
        $user = $this->service->add($request);
        $headers = [
            'Content-Type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json'
        ];
        return $this->presenter->render($user, 200, $headers);
    }

    /**
     * Delete User by id
     */
    public function delete($id){
        $deleted = $this->service->delete($id);

        return response()->json([
            'meta' => [
                'deleted_count' => $deleted,
            ]
        ], 200);
    }

}
