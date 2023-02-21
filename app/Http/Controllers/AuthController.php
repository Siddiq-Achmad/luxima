<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //
    public function checkUser(Request $request)
    {
        // check if user with the same email already exists
        $existingUser = User::where('email', $request->email)->exists();

        if ($existingUser) {
            return response()->json(['error' => 'User already exists with the provided email'], 401);
        }
        else {
            return response()->json(['message' => $request->email+' Valid'],201);
        }

    }

    public function register(Request $request)
    {

        // check if user with the same email already exists
        $existingUser = User::where('email', $request->email)->exists();

        if ($existingUser) {
            return response()->json(['error' => 'User already exists with the provided email'], 401);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        
        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Luxima Access Token');
            $token = $tokenResult->plainTextToken;

            //get user by email
            $getUser = User::with('role.abilities')->where('email', $request->email)->first();

            return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            'user' => $getUser,
            ]);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }
    
    
    public function login(Request $request)
    {
    $request->validate([
    'email' => 'required|string|email',
    'password' => 'required|string',
    'remember_me' => 'boolean'
    ]);

    $credentials = request(['email','password']);
    if(!Auth::attempt($credentials))
    {
    return response()->json([
        'message' => 'Unauthorized'
    ],401);
    }
    else{

    //$user = $request->user();
    $user = $request->user()->with(['userDetail','role.abilities'])->where('email', $request->email)->first();
    // $user = $request->user()->with(['userDetails', 'roles' => function ($query) {
    //     $query->with('abilities');
    //     }])->first();
    $tokenResult = $user->createToken('Luxima Access Token');
    $token = $tokenResult->plainTextToken;
    // $userDetail = $user->userDetails;
    // $role = $user->roles;
    //$ability = $user->role()->with('abilities')->get()->pluck('abilities')->flatten();

    return response()->json([
    'accessToken' => $token,
    'token_type' => 'Bearer',
    'user' => $user,
    ]);
    }
    }



    public function user(Request $request)
    {
    $user = $request->user()->with(['userDetail','role.abilities'])->get();
    // $users = User::with(['userDetails', 'roles'])->get();
    // $user = $request->user()->with(['userDetails','role.abilities'])->first();
    return response()->json($user);
    //return response()->json($request->user());
    }


    public function logout(Request $request)
    {
    $request->user()->tokens()->delete();

    return response()->json([
    'message' => 'Successfully logged out'
    ]);

    }
}
