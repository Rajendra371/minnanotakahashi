<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        session()->forget('checkout_id');
        // session()->forget('4yTlTDKu3oJOfzD_cart_items');
        auth()->logout();

        return response()->json(['status'=>'success','message' => 'Successfully logged out']);
    }
    public function checkauth()
    {
        echo "test";
    }
}
