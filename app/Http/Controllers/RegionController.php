<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RegionController extends Controller
{

    function index(){
        return view('admin.region.index');
    }

    public function get_regions()
    {
        $regions = Region::select('id', 'title', 'code', 'price', 'status');

        return Datatables::of($regions)

            ->addColumn('action', function ($regions) {
                $chk = ($regions->status=='1') ? "checked":"";
                $b = '<a onclick="edit_region('.$regions->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> ';

                $b.= '<a><div class="btn custom-switch">
                  <input type="checkbox" class="custom-control-input myswitch" data-obj="regions" id="customSwitches'.$regions->id.'" '.$chk.' value="'.$regions->id.'">
                    <label class="custom-control-label" for="customSwitches'.$regions->id.'"></label>
                    </div></a>';

                return $b;
            })->make(true);
    }
    function update_user_region(Request $request)
    {
        // echo "<pre>";print_r($request->all());die();
        $region_id=$request->region_id;
        
        $count=count($region_id);
       
         $user_id = auth()->user()->id;
         
         if($user_id!='')
         {
            DB::table('service_regions')->where('user_id', '=', $user_id)->delete();    
         }
         for($i=0;$i<$count;$i++)
         {
             $insert=DB::table('service_regions')->insert([
                'user_id' => $user_id,
                'region_id' => $region_id[$i],
                'status'=>1
                
                ]);
         }
         return 1;
    }

    function edit_region(Request $request){

        $region = Region::whereId($request->id)->first();
        if($region) {
            return response()->json(['success' => true, 'region' => $region]);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function save_region(Request $request){
        $obj = new Region();

        if ($request->id != '') {
            $obj = $obj->findOrFail($request->id);
        }
        $obj->fill($request->all());

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Region updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }
}
