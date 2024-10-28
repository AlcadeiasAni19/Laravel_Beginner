<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $successStatus = 200;

    public function CreateUser(Request $request) {
        $input = $request->validate([
            "user_name" => 'required|min:3|unique:users',
            "email" => ['required', 'email'],
            "password" => ["required", 'min: 5'] 
        ]);
        if ($input){
            $input['password'] = bcrypt($input['password']);
            $UserPost = User::create($input);

            if ($UserPost) {
                return response()->json(["status"=> $this->successStatus, "result"=> $UserPost]);
            } else {
                return response()->json(["message"=>'Data not found']);
            }
        } else return response()->json(["message"=>"Invalid Input"]);
        
    }

    public function GetAllUser(){
        $UserList = User::all();
        return response()->json(["status"=>$this->successStatus,'results'=>$UserList]); 
    }

    public function GetSingleUser($user_id) {
        $UserInfo = User::find($user_id);
        if ($UserInfo) {
            return response()->json(["status"=>$this->successStatus,'result'=>$UserInfo]);
        } 
        else {
            return response()->json(['message'=>'Data not found']);
        }
    }

    // public function Users(){
    //     return view('mypage');
    // }
}
