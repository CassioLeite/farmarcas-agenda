<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            
            $credentials = $request->only('email', 'password');
 
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            if (!auth()->attempt($credentials)) {
                abort(401, 'Credenciais invalidas.');
            }

            $token = auth()->user()->createToken('auth_token');

            return response()
                        ->json([
                            'data' => [
                                'token' => $token->plainTextToken
                            ]
                        ]);
            
        } catch (\Throwable $th) {
            return response()
                        ->json([
                            'data' => [
                                'message' => $th->getMessage(),
                            ]
                        ]);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            
            return response()->json([], 204);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 200]);
        }
    }

    public function register(Request $request, User $user)
    {
        try {
            $userData = $request->only('name', 'email', 'password');
            $userData['password'] = bcrypt($userData['password']);

            $user = $user->create($userData);

            if (!$user) {
                abort(500, 'Erro ao criar usuário.');
            }

            return response()
                        ->json([
                            'data' => [
                                'user' => $user
                            ]
                        ]);
            
        } catch (\Throwable $th) {
            
            return response()
                        ->json([
                            'data' => [
                                'message' => $th->getMessage(),
                            ]
                        ]);
        }
    }
}
