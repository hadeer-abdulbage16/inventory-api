<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    public function register( array $data) : array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $role = $data['role'] ?? 'Cashier';
        $user->assignRole($role);

        $token = $user->createToken('auth_token')->plainTextToken;

       return [
         'user' => $user->load('roles'),
         'token' => $token
       ];
    }


}

