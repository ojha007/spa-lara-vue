<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required|max:191|unique:users',
                'name' => 'required|max:191',
                'role_id' => 'required',
                'status' => 'required',
                'password' => 'required|min:8'
            ]);
        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'role_id' => $request->input('role_id'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
        ]);
        return $user;
    }


    public function index()
    {
        $users = User::with('role')
            ->select('id', 'name', 'email', 'role_id', 'status')
            ->paginate(20);
        return \response()->json($users);
    }

    public function delete(Request $request)
    {

        User::find($request->id)->delete();
        return \response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Deleted SuccessFully ? '
        ]);
    }


}
