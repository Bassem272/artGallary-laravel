<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use App\Mail\verifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function sendTestMail()
    {
        Mail::to('bassem.gehad95@yahoo.com')->send(new MyTestMail());
        return "Test email sent successfully!";
    }





    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            // 'phone'=> this->fake
        ]);
// Generate a verification code/token
// $verificationCode = Str::random(40);

// Associate the code with the user (store it in the database)
// $user->code = $verificationCode;
// $user->save();

// Send an email with the verification link
// Mail::to($user->email)->send(new verifyEmail($verificationCode));

// return response()->json(['message' => 'User registered successfully. Check your email for verification instructions.']);
        $token = $user->createToken('registerauthToken')->plainTextToken;

        return response()->json(
            ['message' => 'User registered successfully.
            Check your email for verification instructions.',
            'token' => $token,
            'user' => $user
        ],201);
    }
    public function verifyEmail($code)
    {
        // Find the user by the verification code
        $user = User::where('code', $code)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }

        // Check if the verification code has expired (e.g., within the last 5 minutes)
        if (Carbon::now()->diffInMinutes($user->created_at) > 5) {
            return response()->json(['message' => 'Verification code has expired'], 400);
        }

        // Update the user's email_verified_at column to mark the email as verified
        $user->email_verified_at = now();
        $user->code = null; // Clear the verification code
        $user->save();

        return response()->json(['message' => 'Email verified successfully']);
    }





    /**
     * User login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'Login successful',
            'token' => $token,'user'=>$user], 201);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'Login successful',
            'token' => $token,'user'=>$user], 201);
        }

        return response()->json(['message' => 'admin only authorized '], 401);
    }

    /**
     * User logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
    /**
     * Revoke all tokens for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeTokens(Request $request)
    {
        $request->user()->tokens->each->delete();

        return response()->json(['message' => 'Tokens revoked successfully']);
    }
}
