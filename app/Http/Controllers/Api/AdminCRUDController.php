<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminCRUDController extends Controller
{
    public function index(Request $req)
    {
        $admins = Admin::paginate($req->all());

        return response()->json($admins, 206);
    }

    public function show(int $id)
    {
        try {
            return Admin::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }
    }

    public function store(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'name' => 'required',
            'username' => 'required|unique:admins,username',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $admin = Admin::create([
            'name' => $req->name,
            'avatar' => null,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'phone' => $req->phone
        ]);

        return response()->json($admin, 201);
    }

    public function update(Request $req, int $id)
    {
        try {
            $admin = Admin::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $admin->update($req->all());

        return response()->json($admin, 200);
    }

    public function destroy(int $id)
    {
        try {
            $admin = Admin::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $admin->delete();

        return response()->json(null, 204);
    }
}
