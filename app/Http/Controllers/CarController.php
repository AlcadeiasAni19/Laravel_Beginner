<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public $successStatus = 200;


    // Car info Insert Function
    public function Car(Request $request){
        $input = $request->all();

        $carPost = Car::create($input);
        if($carPost) {
            $success['car_name'] =  $carPost->car_name;
            return response()->json(["status"=>$this->successStatus,'result'=>$success,]); 
        }else{
            return response()->json(['message'=>'Data Not Save'], ); 
        }
    }

    public function getCarInfo(){
        //$carList = Car::all();
        $carList = Car::orderBy('id','desc')->get();
        //dd($carList);
        return response()->json(['status'=>$this->successStatus,'results'=>$carList]); 
    }

    public function SingleCarInfo ($id){
        $car_info = Car::find ($id);
        if ($car_info) {
            return response()->json(["status"=>$this->successStatus,'result'=>$car_info]);
        } 
        else {
            return response()->json(['message'=>'Data not found']);
        }
    }

    public function UpdateCarInfo (Request $request, $id){
        $getInput = $request->all();

        $carUpdate = Car::find($id);
        $carUpdate->car_name  = $getInput['car_name'];
        $carUpdate->brand  = $getInput['brand'];
        $carUpdate->mileage  = $getInput['mileage'];
        if($carUpdate->save()){
            return response()->json(["status"=>$this->successStatus,'result'=>$carUpdate]);
        } 
        else {
            return response()->json(['message'=>'Data not found']);
        }
    }
}
