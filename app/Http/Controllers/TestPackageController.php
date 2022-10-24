<?php

namespace App\Http\Controllers;

use App\Region;
use App\TestPackage;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestPackageController extends Controller
{

    function index(){
        $test = TestPackage::first();
        return view('admin.test_package.index', compact('test'));
    }

    function save_test_package(Request $request){

        $obj = new TestPackage();

        if ($request->id != '') {
            $obj = $obj->findOrFail(1);
        }
        $obj->fill($request->all());

        if($obj->save()){
            return response()->json(['success' => true, 'message' => 'Region updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }


    }

}
