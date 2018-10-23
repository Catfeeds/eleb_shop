<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $totime = date('Y-m-d H:i:s',time());
        $activities = Activity::where(function ($query) use ($totime){
            $query->where('end_time','>',$totime);
        })->paginate(2);
        return view('activity.list',compact('activities'));
    }

    public function view(Activity $activity)
    {
        return view('activity.view',compact('activity'));
    }
}
