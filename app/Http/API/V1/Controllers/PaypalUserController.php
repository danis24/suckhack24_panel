<?php
namespace App\Http\API\V1\Controllers;

use App\Services\PaypalUsers\PaypalUserService;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\Presenters\JsonApiPresenter;

class PaypalUserController extends Controller{

    private $service;

    public function __construct(PaypalUserService $service){
        $this->service = $service;
        $this->presenter = new JsonApiPresenter;
    }

    public function browse(){
        $users = $this->service->browse();
        return $this->presenter->renderPaginator($users, 200);
    }

    public function read($id){
        $user = $this->service->read($id);
        return $this->presenter->render($user, 200);
    }

    public function add(Request $request){
        $user = $this->service->add($request);
        $headers = [
            'Content-type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json'
        ];
        return $this->presenter->render($user, 200, $headers);
    }

    public function edit($id, Request $request){
        $user = $this->service->edit($id, $request);
        $headers = [
            'Content-type' => 'application/vnd.api+json',
            'Accept' => 'application/vnd.api+json'
        ];
        return $this->presenter->render($user, 200, $headers);
    }

    public function delete($id){
        $deleted = $this->service->delete($id);
        $response = [
            'meta' => [
                'deleted_count' => $deleted,
            ]
        ];
        return response()->json($response, 200);
    }
}
