<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $token = $request->headers->get('X-TOKEN');

        if ($token !== '123') {
            abort(405);
        }

        $cookie = cookie('token', 123, minutes: 60);

        return response()->json([
            'message' => 'success'
        ], 200)->withCookie($cookie);
    }
}
