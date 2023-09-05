<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
            'role_id' => 2,
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'jenis_kelamin' => $request['jenis_kelamin'],
        ];
        $rules = [
            'nama' => 'required',
            'role_id' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'jenis_kelamin' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newUser = new User($data);
        $newUser->save();

        return response()->json([
            'status' => true,
            'message' => 'Register Success',
            'data' => $newUser->load('role')
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => [
                        'email or password wrong',
                    ],
                ],
            ], 401));
        }
        $user->tokens()->delete();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'login has been successfuly',
            'token' => $token,
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'logout success',
        ], 200);
    }
}
