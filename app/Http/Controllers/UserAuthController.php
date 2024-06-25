<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    public function register(Request $request) {
        try {
            // Validate the incoming request data
            $fields = $request->validate([
                'name' => 'required|string',                          // Name is required and must be a string
                'email' => 'required|string|unique:users,email',      // Email is required, must be a string, and must be unique in the users table
                'password' => 'required|string|confirmed'             // Password is required, must be a string, and must be confirmed (should have a matching password_confirmation field)
            ]);
        } catch (ValidationException $e) {
            // If validation fails, catch the exception and return the first error message
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }
    
        // Create a new user with the validated data
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])                // Hash the password before saving it
        ]);
    
        // Generate a new API token for the user
        $token = $user->createToken('myapptoken')->plainTextToken;
    
        // Prepare the response data
        $response = [
            'user' => $user,                                          // Include the user data in the response
            'token' => $token                                         // Include the generated token in the response
        ];
    
        // Return the response with a 201 Created status code
        return response($response, 201);
    }
    
    
    public function login(Request $request) {
        // Validate the incoming request data
        $fields = $request->validate([
            'email' => 'required|string',       // Email is required and must be a string
            'password' => 'required|string'     // Password is required and must be a string
        ]);
    
        // Check if a user with the given email exists
        $user = User::where('email', $fields['email'])->first();
    
        // Check if the user exists and if the provided password matches the stored hashed password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Your credentials does not match'         // Return an error message if the credentials are incorrect
            ], 401);                             // Return a 401 Unauthorized status code
        }
    
        // Generate a new API token for the user
        $token = $user->createToken('myapptoken')->plainTextToken;
    
        // Prepare the response data
        $response = [
            'user' => $user,                    // Include the user data in the response
            'token' => $token                   // Include the generated token in the response
        ];
    
        // Return the response with a 201 Created status code
        return response($response, 201);
    }
    
    public function logout(Request $request) {
        // Get the authenticated user
        $user = auth()->user();
    
        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['message' => 'No authenticated user'], 401);
        }
    
        // Get user's tokens
        $tokens = $user->tokens;
    
        // Check if user has tokens
        if ($tokens->isEmpty()) {
            return response()->json(['message' => 'No tokens found for the user'], 404);
        }
    
        // Delete all tokens for the authenticated user
        $user->tokens()->delete();
    
        // Return a message indicating the user has been logged out
        return response()->json(['message' => 'Logged out'], 200);
    }
    
    
}
