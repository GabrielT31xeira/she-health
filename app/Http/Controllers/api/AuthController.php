<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->all())) {
                $user = Auth::user();
                $token = $user->createToken('projectAPI')->accessToken;
                return response()->json([
                    'message' => 'User logged in successfully',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'error' => 'Error in credentials'
                ], 401);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'identifier' => $request->identifier,
                'user_actor' => $request->user_actor,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Usuario criado com sucesso',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error has occurred',
                'info' => $exception->getMessage(),
            ],500);
        }
    }
}
