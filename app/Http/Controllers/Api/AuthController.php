<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User registered succssfuly',
            'data' => [
               'user' => $result['user'],
               'token' => $result['token']
            ] 
            
        ],201);

    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

       return response()->json([
        "success" => true ,
        "message" => 'User Loged in succssfuly',
        "data" => [
            "user" => $result['user'],
            "token" => $result['token']
        ],

        ]);
    }

    public function logout( Request $request )
    {
        $this->authService->logout($request->user());

        return response()->json([
        "success" => true ,
        "message" => 'User Loged out succssfuly',
        ] ,201);


    }
}
