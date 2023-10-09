<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use JsonResponse;

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Authentication"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Credenciais invalidas.", @OA\JsonContent()),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="Logout user and delete JWT token",
     *     tags={"Authentication"},
     *     @OA\Response(response="204", description=""),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();

            return response()->json([], 204);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Authentication"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Usuário criado com sucesso.", @OA\JsonContent()),
     *     @OA\Response(response="500", description="E-mail já está sendo utilizado.", @OA\JsonContent()),
     *     @OA\Response(response="409", description="Erro ao criar usuário.", @OA\JsonContent()),
     * )
     */
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
                throw new Exception("Erro ao criar usuário.", 409);
            }

            return $this->success($user, "Usuário criado com sucesso.");
            
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
