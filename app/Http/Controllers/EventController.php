<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //配置中间件
   public function __construct(Request $request)
    {
        $this->middleware('auth',[

        ]);
    }
    public function index()
    {
        $totime = time();
        $eventmembers = EventMember::all();
        $events = Event::all();
        return view('event.list',compact('events','totime','eventmembers'));
    }

    public function signup(Request $request,Event $event)
    {
        //将报名的商户id 与 所报名活动的ID 保存到活动报名表
        EventMember::create(['member_id'=> Auth::user()->id,'events_id'=>$event->id]);
        return redirect()->route('events.index')->with('success','恭喜您，报名成功');
    }
}
