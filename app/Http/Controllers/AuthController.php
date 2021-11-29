<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credenciais);

        if (!$token) {
            return response()->json(['erro' => 'Usuário e senha inválidos.'], 403);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
    public function logout()
    {
        $token = auth('api')->refresh();
        return response()->json(['msg' => 'Logout realizado com sucesso.']);
    }
    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
}
