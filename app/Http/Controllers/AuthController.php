<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\ModelHasRole;
class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
              'email'=>'required|email|unique:users',
            // 'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        if($request->user()){
            $request->user()->tokens()->delete();

            return [
                'message' => 'Logged out Succesfully'
            ];
        }else{
            return [
                'message' => 'Not login'
            ];
        }
    }
     public function user_register(Request $request)
    {
        //   $fields = $request->validate([
        //     'name' => 'required|string',
        //     //   'email'=>'required|email|unique:users',
        //     'email' => 'required|string|unique:users,email',
        //     // 'password' => 'required|string|confirmed'
        // ]);
          
       $rules = [
    "name" => 'required|string',
    'email' => 'required|string|unique:users,email',
    'password' => 'required|string| min:8',
       ];
$messages = [
    "name" => "Name Is required",
    "email.unique" => "email Is already Exist.",
    "password.min"=>"Minimum Password Will Be 8 "
];

$validator = Validator::make($request->all(), $rules, $messages);

if ($validator->fails()) {
    return response($validator->errors(), 400);
}else{
     
        if($request->hasFile('image'))
        {
           $imageName = time().'.'.$request->image->extension(); 
          $request->image->storeAs('public/user', $imageName);
        }else{
            $imageName=''  ;
        }
        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path'=>$imageName,
        ]);
        $user_id=User::select('id')->OrderBy('id','DESC')->first();
        $roles = ModelHasRole::create([
            'role_id' => '3',
            'model_type'=>'App\Models\User',
            'model_id'=>$user_id->id
        ]);
         $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
}
    }
        public function me(Request $request)
     {
     // return response(Auth()->user()->name);
     return $request->user();
    }
}
