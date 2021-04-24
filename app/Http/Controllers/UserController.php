<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // get all user from users table
      $user = User::all();
      return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $validator = Validator::make($request->all(), [ //make validation
          'username' => 'required|max:20',
          'email' => 'required|email|unique:users,email',
          'number' => 'required|max:11',
          'about' => 'max:50',
          'gender' => 'min:3'
      ]);

      if ($validator->fails()) { // if validation fails
          return $validator->errors();
      }

      // sit new entry
      $user = new User;
      $user->username = $request->username;
      $user->email= $request->email;
      $user->number= $request->number;
      $user->about= $request->about;
      $user->gender= $request->gender;

      $user->save();
      return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      return response()->json($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::find($id); //get user by id

      // update values
      $user->username = $request->input('username');
      $user->email = $request->input('email');
      $user->number = $request->input('number');
      $user->about = $request->input('about');
      $user->gender = $request->input('gender');
      $user->save();
      return response()->json(['User Has been Updated!',$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();
      return response()->json(['User has been removed!', $user]);
    }
}
