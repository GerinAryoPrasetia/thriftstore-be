<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register Buyer
    public function registerUser(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone' => $fields['phone'],
            'role' => 'buyer'
        ]);

        $token = $user->createToken('token', ['user'])->plainTextToken;

        $response = [
            'code' => 201,
            'message' => 'User Berhasil Dibuat',
            'data' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }

    public function loginUser(Request $request)
    {
        //Login Buyer
        //validation request on body
        $fields = $request->validate([
            'email' => 'required|string', //uniqe terhadap tabel users dan field email
            'password' => 'required|string',
        ]);

        //check email
        $user = User::where('email', $fields['email'])->first(); //query

        //check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Email atau Password Salah'
            ], 401);
        }
        $token = $user->createToken('token', ['user'])->plainTextToken;

        $response = [
            'code' => 200,
            'message' => 'Login User Berhasil',
            'data' => $user,
            'token' => $token,
        ];
        return response($response, 200);
    }


    public function registerSeller(Request $request)
    {
        //Register Seller
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:sellers,email',
            'password' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $seller = Seller::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone' => $fields['phone'],
            'role' => 'seller',
        ]);

        //Create Token
        $token = $seller->createToken('token', ['seller'])->plainTextToken;

        $response = [
            'code' => 201,
            'message' => 'Seller Berhasil Dibuat',
            'data' => $seller,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function loginSeller(Request $request)
    {
        //Login Seller
        //validation request on body
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check email
        $admin = Seller::where('email', $fields['email'])->first(); //query

        //check password
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'message' => 'Email atau Password Salah'
            ], 401);
        }

        //Create Token
        $token = $admin->createToken('token', ['seller'])->plainTextToken;

        $response = [
            'code' => 200,
            'message' => 'Login Seller Berhasil',
            'data' => $admin,
            'token' => $token,
        ];
        return response($response, 200);
    }
}
