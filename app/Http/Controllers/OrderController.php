<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(2);
        return view('order.list', compact('orders'));
    }

    public function view(Order $id)
    {
        return view('order.view',compact('id'));
    }

    public function cancel(Order $id)
    {
        Order::where('id',$id->id)->update(['status'=>-1]);
        return redirect()->intended(route('order.index'))->with('success','取消订单成功');
    }

    public function send(Order $id)
    {
        Order::where('id',$id->id)->update(['status'=>2]);
        return redirect()->route('order.index')->with('success','发货成功');
    }
}