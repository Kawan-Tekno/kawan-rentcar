<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $admin = Admin::where('username', $req->username)
            ->first();

        if (!$admin) {
            return response()
                ->json([
                    'error' => 'username not found',
                ], 404);
        }

        if(!Hash::check($req->password, $admin->password)) {
            return response()
                ->json([
                    'error' => 'password incorec',
                ], 405);
        }

        return response()
            ->json([
                'token' => $admin->createToken('admin')->plainTextToken
            ], 200);
    }

    public function logout(Request $req)
    {
        $req->user()
            ->tokens()
            ->delete();

        return response()
            ->json([
                'message' => 'successfully logout',
            ], 200);
    }
}
