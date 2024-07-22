<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
   
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => 'Validation Error',
                'data' => [$validator->errors()]
            ];
      
            return response()->json($response, 401);
        }

        $user = User::create($validator->validated());

        $user->token = $user->createToken('laragames')->plainTextToken;

        $response = [
            'success' => true,
            'message' => 'User register successfully',
            'data' => [$user]
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => 'Validation Error',
                'data' => [$validator->errors()]
            ];
      
            return response()->json($response, 401);
        }

        if(Auth::attempt($validator->validated())) {

            $user = Auth::user();

            $user->tokens()->where('name', 'laragames')->delete();

            $user->token = $user->createToken('laragames')->plainTextToken;

            $response = [
                'success' => true,
                'message' => 'User logged in successfully',
                'data' => $user
            ];

            return response()->json($response, 200);

        }

        $response = [
            'success' => false,
            'message' => 'The provided credentials are incorrect',
            'data' => []
        ];

        return response()->json($response, 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'success' => true,
            'message' => 'User logged out successfully',
            'data' => []
        ];

        return response()->json($response, 200);
    }
}
