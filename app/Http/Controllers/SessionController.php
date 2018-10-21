<?php

namespace App\Http\Controllers;

use App\Model\Shops;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    //创建中间件并配置
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['login','verify'],
        ]);
    }
    public function login()
    {
        return view('session.login');
    }

    public function verify(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'password'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'商家账号不能为空',
            'password.required'=>'商家密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember')))
        {
            if (Auth::user()->status){
                $shop = Shops::find(Auth::user()->shop_id);
                if($shop->status == '0'){
                    Auth::logout();
                    return back()->with('danger','您的店铺状态待审核，请联系管理员')->withInput();
                }
                elseif($shop->status == '-1')
                {
                    Auth::logout();
                    return back()->with('danger','您的店铺被禁用，请联系管理员')->withInput();
                }
                return redirect()->intended(route('menus.index'))->with('success','恭喜您！登录成功');
            }else{
                Auth::logout();
                return back()->with('danger','您的账号未通过审核，请联系管理员')->withInput();

            }
        }else{
            return back()->with('danger','账号或密码错误，请重新填写')->withInput();
        }

    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('session.edit',compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'oldpassword'=>'required',
           'password'=>'required',
           'repassword'=>'required',
        ],[
            'oldpassword.required'=>'旧密码不能为空',
            'password.required'=>'密码不能为空',
            'repassword.required'=>'确认密码不能为空',
        ]);
        $user = User::find($request->id);
        if(Hash::check($request->oldpassword,$user->password)){
            if($request->password == $request->repassword){
                Auth::logout();
                $user->where('id',$request->id)->update(['password'=>bcrypt($request->password)]);
                return redirect()->route('login')->with('success','修改密码成功，记住密码哦');
            }else{
                return back()->with('danger','新密码与确认密码不一致')->withInput();
            }
        }else{
            return back()->with('danger','旧密码不正确，请重新输入')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();//删除sessiont 安全推出
        return redirect()->route('login')->with('success','安全退出');
    }
}
