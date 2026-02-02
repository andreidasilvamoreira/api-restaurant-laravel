<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use hasApiTokens;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        $token = $user->createToken('postman')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
            'device_name' => "postman",
            'message' => 'Logado com sucesso!'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Usuário deslogado com sucesso!'], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'message' => $request->user()
        ]);
    }

    public function logoutSecurity(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Dispositivos deslogados com sucesso!'], 200);
    }
}
