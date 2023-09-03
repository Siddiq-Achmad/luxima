<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        //get all User
        $users = User::with(['userDetail', 'role'])->get();

        //return collection of posts as a resource
        return new UserResource(true, 'List Data Users', $users);
    }


    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'avatar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $avatar = $request->file('avatar');
        $avatar->storeAs('public/images/user', $avatar->hashName());

        //create post
        $user = User::create([
            'avatar'     => $avatar->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        //return response
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }

    public function show($id)
    {
        //find post by ID
        // $user = User::find($id);

        $user = User::with(['userDetail', 'role.abilities'])->where('id', $id)->first();

        //return single post as a resource
        return new UserResource(true, 'Data Detail User!', $user);
    }
}
