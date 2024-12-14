<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // bisa tambah register sebagai apa, pelanggan atau mitra

        // Return a success response
        return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
    }

    // buat sekarang
    public function registerAdmin(Request $request) 
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a success response
        return response()->json(['message' => 'Admin registered successfully!', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = null;
        if ($request->has("admin")) {
            $user = Admin::where('email', $request->email)->first();
        } else {
            // Attempt to find the user by email
            $user = Pengguna::where('email', $request->email)->first();
        }

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}