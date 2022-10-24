<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('admin.notification.index');
    }

    public function get_notifications()
    {
        $notifications = Notification::where('notify_status','Requested')->latest();

        return Datatables::of($notifications)

            ->addColumn('notify_type', function ($notifications) {
                $notify_type = Str::title($notifications->notify_type);

                return $notify_type;
            })
            ->addColumn('user_name', function ($notifications) {
                $user_name = $notifications->instructer_info->name .' '.$notifications->instructer_info->lname;

                return $user_name;
            })
            ->addColumn('action', function ($notifications) {
                $b = '<button class="btn btn-xs m-b-5 btn-primary notify_view_status" data-id="'.$notifications->id.'" data-user_id="'.$notifications->user_id.'"><i class="fa fa-eye"></i> View</button> ';

                return $b;
            })
            ->make(true);
    }

    public function view_notification($notificationId)
    {
        $notification = Notification::where('id',$notificationId)->where('notify_status','Requested')->first();
        if($notification){
            $notification->notify_view = 1;
            $notification->save();
            $notify_type = $notification->notify_type;
            return response()->json(['success' => true, 'message' => 'Notification view successfully','notify_type'=>$notify_type]);
        }else{
            return response()->json(['success' => false, 'message' => 'Notification already view.']);
        }
        
    }
}
