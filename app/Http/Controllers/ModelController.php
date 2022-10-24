<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\CarModel;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ModelController extends Controller
{

    function index($car){
        $make_detail = CarMake::whereId($car)->first();
        return view('admin.model.index', compact('car', 'make_detail'));
    }

    public function get_models($car)
    {
        $models = CarModel::select('id', 'title')->where('make_id',$car);

        return Datatables::of($models)

            ->addColumn('action', function ($models) {
                
                $b = '<a href="years/'.$models->id.'" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-eye"></i> View Years</a> ';
                $b.= '<a onclick="edit_model('.$models->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp; <a onclick="delete_model('.$models->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger"><i class="fa fa-times"></i>  Delete</a>';

                return $b;
            })->make(true);
    }

    function edit_model(Request $request){

        $model = CarModel::whereId($request->id)->first();
        if($model) {
            return response()->json(['success' => true, 'model' => $model]);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function save_model(Request $request){
        $obj = new CarModel();

        if ($request->id != '') {
                $obj = $obj->findOrFail($request->id);
            }
        $obj->fill($request->all());

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Car Model updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }



    public function add_model(Request $request)
    {
         $model = new CarModel();

        /*validate duplicate model*/
        if(CarModel::where('title', $request->title)->where('make_id', $request->make_id)->exists()){
            return response()->json(['success' => false, 'message' => 'A model already registered with '. $request->title]);
        }


        $model->fill($request->all());

        if ($model->save()) {
            return response()->json(['success' => true, 'message' => 'Model Added Successfully ']);
        } else {
            return response()->json(['success' => false, 'message' => 'An Error Occured, Car Not Saved']);
        }
    }


    function delete_model(Request $request){

        DB::table('car_year')->where('model_id', $request->model_id)->delete();
        $del = DB::table('car_model')->where('id', $request->model_id)->delete();
        if($del) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted.']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

}
