<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\CarModel;
use App\YearModel;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class YearController extends Controller
{

    function index($model){
        
        $model_detail = CarModel::whereId($model)->first();
        $make_detail = CarMake::whereId($model_detail->make_id)->first();
        return view('admin.year.index', compact('model', 'model_detail', 'make_detail'));
    }

    public function get_years($model)
    {
        $years = YearModel::select('id', 'title', 'image')->where('model_id',$model);

        return Datatables::of($years)

            ->addColumn('action', function ($years) {
                
                //$b= '<img src="assets/images/cars/'.$years->image.'" width="150"> &emsp; &emsp; <a onclick="edit_year('.$years->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp; <a onclick="delete_year('.$years->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger"><i class="fa fa-times"></i>  Delete</a>';
                $b= '<a onclick="edit_year('.$years->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> &nbsp; <a onclick="delete_year('.$years->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger"><i class="fa fa-times"></i>  Delete</a>';

                return $b;
            })->make(true);
    }

    function edit_year(Request $request){

        $year = YearModel::whereId($request->id)->first();
        if($year) {
            return response()->json(['success' => true, 'year' => $year]);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function save_year(Request $request){
        $obj = new YearModel();

        if ($request->id != '') {
                $obj = $obj->findOrFail($request->id);
            }
        $obj->fill($request->all());

        // image
        $obj->image = "";
        // if ($request->hasFile('new_img')) {
        //     $file_name = time() . '.' . $request->new_img->getClientOriginalExtension();
        //     $request->new_img->move(base_path() . '/assets/images/cars/', $file_name);
        //     $obj->image = $file_name;
        // }
        // else
        // {
        //     $obj->image = $request->old_img;
        // }

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Model Year updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }



    public function add_year(Request $request)
    {
         $year = new YearModel();

        /*validate duplicate year*/
        if(YearModel::where('title', $request->title)->where('model_id', $request->model_id)->exists()){
            return response()->json(['success' => false, 'message' => 'An year already registered with '. $request->title]);
        }

        // image
        $obj->image = "";
        // if ($request->hasFile('Newimage')) {
        //     $file_name = time() . '.' . $request->Newimage->getClientOriginalExtension();
        //     $request->Newimage->move(base_path() . '/assets/images/cars/', $file_name);
        //     $year->image = $file_name;
        // }


        $year->fill($request->all());

        if ($year->save()) {
            return response()->json(['success' => true, 'message' => 'Model Year Added Successfully ']);
        } else {
            return response()->json(['success' => false, 'message' => 'An Error Occured, Car Not Saved']);
        }
    }


    function delete_year(Request $request){

        $del = DB::table('car_year')->where('id', $request->year_id)->delete();
        if($del) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted.']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }
}
