<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use JsonResponse;

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
 
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            if (!auth()->attempt($credentials)) {
                throw new Exception("Credenciais invalidas.", 401);
            }

            $token = auth()->user()->createToken('auth_token');

            return $this->success(['token' => $token->plainTextToken]);
            
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();

            return response()->json([], 204);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function register(Request $request, User $user)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $userExists = $user->where('email', '=', $request->get('email'))->whereNull('deleted_at')->get()->first();

            if ($userExists) {
                throw new Exception("E-mail já está sendo utilizado.", 500);
            }

            $userData = $request->only('name', 'email', 'password');
            $userData['password'] = bcrypt($userData['password']);

            $user = $user->create($userData);

            if (!$user) {
                throw new Exception("Erro ao criar usuário", 500);
            }

            return $this->success($user, "Usuário criado com sucesso.");
            
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
