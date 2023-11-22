<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class authController extends Controller
{
   public function register(Request $request){
    try {
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=> 'required|string',
            'password'=>'required|string'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'StatusCode'=>400,
            'StatusDescription'=>'Bad Request',
            'Data'=>[],
            'Message'=>$e->getMessage(),
        ], 400);
    }
    $validatemail = $request->input('email');
    $result =  User::where('email', $validatemail)->get();
     try {
        $user = User::create($fields);
        $token = $user->createToken('mogasstoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token'=> $token
        ];
        return response($response, 201);
  } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];

            return response()->json([
                'StatusCode'=>1062,
                'StatusDescription'=>'Error duplicate entry',
                'Data'=>[$result],
                'Message'=>'Credential already exists'
            ]);
   }
  }
   public function login(Request $request){
    $fields = $request->validate([
        'email'=> 'required|string',
        'password'=>'required|string'
    ]);
    $user =User::where('email',$fields['email'])->where('password',$fields['password'])->first();
    if(!$user){
        return response([
            'message'=>'Unidentified user'
        ], 401);

    }
    else{

$token = $user->createToken('mogasstoken')->plainTextToken;
$response = [
    'user' => $user,
    'token'=> $token
];
return response($response, 201);
    }
   }
   public function logout(Request $request){
    if (auth()->check()) {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message'=>'loggedout'
        ]);
    }

   }
}
