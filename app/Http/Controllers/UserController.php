<?php

namespace App\Http\Controllers;

use App\Model\Shops;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        //验证数据
        //保存数据
        $shop_img_path = $request->file('shop_img')->store('public/shops');
        $user_data = [
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'remember_token'=> str_random(40),
            'status'=>'0',
            ];
        $shops_data = [
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$shop_img_path,
            'brand'=>$request->has('brand') ?? 0,
            'on_time'=>$request->has('on_time') ?? 0,
            'fengniao'=>$request->has('fengniao') ?? 0,
            'piao'=>$request->has('piao') ?? 0,
            'zhun'=>$request->has('zhun') ?? 0,
            'bao'=>$request->has('bao') ?? 0,
            'status'=>'0'
        ];

        User::create($user_data);
        Shops::create($shops_data);
        //跳转
        //return redirect()->route('login')->with('success','恭喜您！注册成功');
    }

}
