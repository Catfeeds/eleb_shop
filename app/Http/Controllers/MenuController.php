<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\Shops;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    //构造函数中使用中间件
    public function __construct()
    {
        //对中间件进行配置，middleware 对需要登录的才能访问的方法做权限验证
        $this->middleware('auth',[
            //除了哪些方法需要验证才可以访问  哪个写的少就写哪一个
            //'except'=>['index'],
            //只对哪些方法需要验证才可以访问
            //'only'=>[],
        ]);
    }

    public function index()
    {
        $menus = Menu::paginate(2);
        return view('menu.list',compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request,Menu $menu)
    {


        $this->validate($request,[
            'goods_name' => 'required',
            'shop_id' => 'required',
            'rating'=>'required',
            'category_id' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'month_sales' => 'required',
            'rating_count' => 'required',
            'tips' => 'required',
            'satisfy_count' => 'required',
            'satisfy_rate' => 'required',
            'status'=>'required',
            'goods_img'=>'required',
        ]);
        $data = [
            'goods_name' => $request->goods_name,
            'shop_id' => $request->shop_id,
            'rating'=>$request->rating,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'status' => $request->status,
            'goods_img'=>$request->goods_img,
        ];
        Menu::create($data);
        return redirect()->route('menus.index')->with('success','增加菜品成功');
    }

    public function edit(Request $request,Menu $menu)
    {
        return view('menu.edit',compact('menu'));
    }

    public function update(Request $request,Menu $menu)
    {
        $this->validate($request,[
            'goods_name' => 'required',
            'shop_id' => 'required',
            'rating'=>'required',
            'category_id' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'month_sales' => 'required',
            'rating_count' => 'required',
            'tips' => 'required',
            'satisfy_count' => 'required',
            'satisfy_rate' => 'required',
            'status'=>'required',
        ]);
        $data = [
            'goods_name' => $request->goods_name,
            'shop_id' => $request->shop_id,
            'rating'=>$request->rating,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'status' => $request->status,
        ];
        if($request->has('goods_img')){
            $data['goods_img'] = $request->file('goods_img')->store('public/menus');
        }
        $menu->update($data);
        return redirect()->route('menus.index')->with('success','修改菜品成功');

    }
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除菜品成功');
    }
}
