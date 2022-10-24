<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\CarModel;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CarController extends Controller
{

    function index(){
        return view('admin.car.index');
    }

    public function get_cars()
    {
        $cars = CarMake::select('id', 'title', 'status');

        return Datatables::of($cars)

            ->addColumn('action', function ($cars) {
                $chk = ($cars->status=='1') ? "checked":"";
                
                $b = '<a href="models/'.$cars->id.'" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-eye"></i> View Models</a> ';

                $b.= '<a onclick="edit_car('.$cars->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> <a onclick="delete_car('.$cars->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger"><i class="fa fa-times"></i>  Delete</a>&emsp;';

                $b.= '<a><div class="btn custom-switch">
                  <input type="checkbox" class="custom-control-input myswitch" data-obj="cars" id="customSwitches'.$cars->id.'" '.$chk.' value="'.$cars->id.'">
                    <label class="custom-control-label" for="customSwitches'.$cars->id.'"></label>
                    </div></a>';

                return $b;
            })->make(true);
    }

    function edit_car(Request $request){

        $car = CarMake::whereId($request->id)->first();
        if($car) {
            return response()->json(['success' => true, 'car' => $car]);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function save_car(Request $request){
        $obj = new CarMake();

        if ($request->id != '') {
            $obj = $obj->findOrFail($request->id);
        }
        $obj->fill($request->all());

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Car updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }



    public function add_car(Request $request)
    {
         $car = new CarMake();

        /*validate duplicate car*/
        if(CarMake::where('title', $request->title)->exists()){
            return response()->json(['success' => false, 'message' => 'A car already registered with '. $request->title]);
        }

        $car->fill($request->all());

        if ($car->save()) {
            return response()->json(['success' => true, 'message' => 'Car Added Successfully ']);
        } else {
            return response()->json(['success' => false, 'message' => 'An Error Occured, Car Not Saved']);
        }
    }


    function delete_car(Request $request){

        $models = CarModel::select('id')->where('make_id', $request->car_id)->get();

        if(!empty($models))
        {
            foreach ($models as $key => $model) 
            {
                DB::table('car_year')->where('model_id', $model['id'])->delete();
                DB::table('car_model')->where('id', $model['id'])->delete();
            }
        }
        
        $del = DB::table('car_make')->where('id', $request->car_id)->delete();
        
        if($del) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted.']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }
}
