<?php

namespace App\Services\PaypalUsers;

use Illuminate\Contracts\Support\Arrayable;
use Uuid;

class PaypalUserService{
    private function newUser(){
        return new PaypalUser;
    }

    public function browse(){
        return $this->newUser()->paginate();
    }

    public function read($id){
        return $this->newUser()->findByUuid($id);
    }

    public function edit($id, Arrayable $payload){
        $user = $this->read($id);
        foreach($payload->toArray() as $key => $value){
            $user->setAttribute($key, $value);
        }
        $user->save();
        return $user;
    }

    public function add(Arrayable $payload){
        return $this->newUser()->create($payload->toArray());
    }

    public function delete($id){
        return $this->newUser()->destroyByUuid($id);
    }
}
