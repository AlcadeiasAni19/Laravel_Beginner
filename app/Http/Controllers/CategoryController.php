<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $successStatus = 200;

    public function CreateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories|min:3',
            'is_set' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(["error"=> $validator->errors()], 401);
        }

        $input = $request-> all();
        
        $CategoryPost = Category::create($input);

        if ($CategoryPost) {
            return response()->json(["status"=>$this->successStatus,'result'=>$CategoryPost]); 
        } else {
            return response()->json(['message'=>'Data Not Save'], ); 
        }
    }

    public function GetAllCategory(){
        $CategoryList = Category::orderBy('id','asc')->get();
        return response()->json(["status"=>$this->successStatus,'results'=>$CategoryList]); 
    }

    public function GetSingleCategory ($category_id){
        $CategoryInfo = Category::find ($category_id);
        if ($CategoryInfo) {
            return response()->json(["status"=>$this->successStatus,'result'=>$CategoryInfo]);
        } 
        else {
            return response()->json(['message'=>'Data not found']);
        }
    }
}
