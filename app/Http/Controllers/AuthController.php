<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request): JsonResponse {
        $user = User::query()
            ->where("email", $request->input("email"))
            ->first();

        if ($user == null) {
            return response()->json([
                "status" => false,
                "message" => "email tidak ditemukan",
                "data" => null
            ]);
        }

        if (!Hash::check($request->input("password"), $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "password salah",
                "data" => null
            ]);
        }

        $token = $user->createToken("auth");

        return response()->json([
            "status" => true,
            "message" => "berhasil login",
            "data" => [
                "user" => $user,
                "auth" => [
                    "token" => $token->plainTextToken,
                    "token_type" => 'bearer'
                ]
            ]
        ]);
    }

    function register(Request $request): JsonResponse {
        $user = User::query()
            ->where("email", $request->input("email"))
            ->first();

        if ($user != null) {
            return response()->json([
                "status" => false,
                "message" => "email telah terdaftar",
                "data" => null
            ]);
        }

        User::query()->create($request->all());

        return response()->json([
            "status" => true,
            "message" => "berhasil register",
            "data" => null
        ]);
    }

    function user(Request $request): JsonResponse {
        return response()->json([
            "status" => true,
            "message" => "berhasil login",
            "data" => $request->user()
        ]);
    }
}
