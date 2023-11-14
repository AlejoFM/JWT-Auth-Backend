<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenController extends Controller
{
    /**
     *
     * TODO : Servicio de mailing, el cual una de sus funcionalidades es recuperar contraseña.
     *
     */

    /**
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(($request->password)),
            'token_update_date' => now(),
        ]);
        $token = JWTAuth::fromUser($admin);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'admin' => $admin,
            'token' => $token,
        ]);
    }


    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return "Credenciales inválidas";
        }
        try {
            $token = JWTAuth::fromUser($admin);
        }catch (JWTException $e){
            return "error";
        }
        return $token;
    }

    public function change_password(Request $request){

        $admin = Auth::guard('api')->user();
        $newPassword = $request->input('new_password');


        $admin->password = Hash::make($newPassword);
        $admin->token_update_date = now();

        $admin->save();

        return "Password successfully changed";
    }

    public function remember_password(){

        return "email sent";
    }
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
