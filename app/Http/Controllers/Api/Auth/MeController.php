<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;


class MeController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('jwt.auth');
    }
    public function me()
    {
        // echo json_encode('asd');
         //return new UserResource($this->request->user());
        //  $data=auth()->user()->locationid;
       //$data=consts()
        //   return $data;
        $user=\JWTAuth::toUser();
        return json_encode($user);
        // $user = $this->jwt->User();

    }
}
