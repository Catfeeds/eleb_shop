<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SmailController extends Controller
{
    public function send()
    {
        Mail::raw('恭喜您中奖了',function ($message){
            $message->subject('恭喜您中奖了，赶快产看您的奖品吧！');
            $message->to('myvtcyahoo@163.com');
        });
    }
}
