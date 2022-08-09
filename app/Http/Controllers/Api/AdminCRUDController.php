<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
        $admin = Admin::create($req->all());

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
