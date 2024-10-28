<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public $successStatus = 200;

    public function CreateProduct(Request $request){
        $input = $request->validate([
            'product_name' => 'required|min: 3|unique:products',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required'
        ]);
        
        $ProductPost = Product::create($input);
        if ($ProductPost) {
            return response()->json(["status"=>$this->successStatus,'result'=>$ProductPost]); 
        } else {
            return response()->json(['message'=>'Data Not Save'], ); 
        }
    }

    public function GetAllProduct() {
        $ProductList = Product::orderBy('id','asc')->get();
        return response()->json(["status"=>$this->successStatus,'results'=>$ProductList]); 
    }

    public function GetSingleProduct ($product_id) {
        $ProductInfo = Product::with("user","category")->where("id",$product_id)->first();
        if ($ProductInfo) {
            $Result['product_id'] = $ProductInfo->id; 
            $Result['product_name'] = $ProductInfo->product_name; 
            $Result['category_name'] = $ProductInfo->category->category_name; 
            $Result['user_name'] = $ProductInfo->user->user_name;
            $Result['quantity'] = $ProductInfo->quantity;
            $Result['unit'] = $ProductInfo->unit;
            $Result['price'] = $ProductInfo->price;

            return response()->json(["status"=>$this->successStatus,'result'=>$Result]);
        } 
        else {
            return response()->json(['message'=>'Data not found']);
        }
    }

    // public function UpdateCarInfo (Request $request, $id){
    //     $getInput = $request->all();

    //     $carUpdate = Car::find($id);
    //     $carUpdate->car_name  = $getInput['car_name'];
    //     $carUpdate->brand  = $getInput['brand'];
    //     $carUpdate->mileage  = $getInput['mileage'];
    //     if($carUpdate->save()){
    //         return response()->json(["status"=>$this->successStatus,'result'=>$carUpdate]);
    //     } 
    //     else {
    //         return response()->json(['message'=>'Data not found']);
    //     }
    // }
}
