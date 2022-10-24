<?php

use App\CarMake;
use App\CarModel;
use App\DrivingLicence;
use App\InstructorLicence;
use App\Notification;
use App\WwccLicence;

function getNotificationCount(){
    $notificationCount = Notification::where('notify_view',0)->count();
    return $notificationCount;
}

function getInstructorNotificationCount($user_id){
    $notificationCount = Notification::where('user_id',$user_id)->where('requested_user_view',0)->count();
    return $notificationCount;
}

function carMake($id){
    $make = CarMake::where('id',$id)->select('title')->first();
    $title = $make->title;
    return $title;
}

function carModel($id){
    $model = CarModel::where('id',$id)->select('title')->first();
    $title = $model->title;
    return $title;
}

function drivingLicenceStatus($user_id){
    $drivingLicence = DrivingLicence::where('user_id',$user_id)->orderBy('id','desc')->select('id','driving_licence_status')->first();
    if($drivingLicence){
        return $drivingLicence->driving_licence_status;
    }else{
        return false;
    }
    
}

function instructorLicencesStatus($user_id){
    $instructorLicence = InstructorLicence::where('user_id',$user_id)->orderBy('id','desc')->select('id','instructor_licence_status')->first();
    if($instructorLicence){
        return $instructorLicence->instructor_licence_status;
    }else{
        return false;
    }    
}

function wwccLicencesStatus($user_id){
    $wwccLicence = WwccLicence::where('user_id',$user_id)->orderBy('id','desc')->select('id','wwcc_licence_status')->first();
    if($wwccLicence){
        return $wwccLicence->wwcc_licence_status;
    }else{
        return false;
    }    
}