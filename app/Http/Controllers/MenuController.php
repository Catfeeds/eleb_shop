<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use App\Model\Shops;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function index(Request $request)
    {
        //获取搜索的关键字
        $categoryid = $request->cateid?$request->cateid:'';
        $keywords = $request->keywords?$request->keywords:'';
        $start = $request->start?$request->start:'';
        $end = $request->end?$request->end:'';
        if($categoryid)
        {
            if($keywords || $start){
                if ($keywords && $start){
                    $data = Menu::where('category_id',$categoryid)
                        ->where('goods_name','like','%'.$keywords.'%')
                        ->whereBetween('goods_price',[$start,$end])
                        ->select('*')
                        ->get();
                }elseif ($keywords){
                    $data = Menu::where('category_id',$categoryid)
                        ->where('goods_name','like','%'.$keywords.'%')
                        ->select('*')
                        ->get();
                }elseif ($start){
                    $data = Menu::where('category_id',$categoryid)
                        ->where('goods_price',[$start,$end])
                        ->select('*')
                        ->get();
                    var_dump($categoryid,$start,$end);
                    var_dump($data);exit;
                }
            }else{
                $data = Menu::where('category_id',$categoryid)
                    ->select('*')
                    ->get();
            }
        }else{
            if($keywords || $start){
                if($keywords && $start){
                        $data = Menu::where('goods_name',$keywords)
                            ->whereBetween('goods_price',[$start,$end])
                            ->select('*')
                            ->get();
                }elseif ($keywords){
                        $data = Menu::where('goods_name',$keywords)
                            ->select('*')
                            ->get();
                }elseif ($start){
                        $data = Menu::whereBetween('goods_price',[$start,$end])
                            ->select('*')
                            ->get();
                }

            }else{
                $data = Menu::select('*')->get();
            }
        }
        //$keywords = $request->keywords?$request->keywords:'';//如果请求里面keywords 有值就取，没有值就是空
        //$catelist = MenuCategory::where('shop_id',auth()->user()->shop_id)->get();
        //$menus = Menu::where('shop_id',auth()->user()->shop_id)->get();
       /* $data = Manager::where(function($query) use($keywords){
            if(!empty($keywords)){
                $query->where('username','like','%'.$keywords.'%');
                //->orwhere('','like','%'.$keywords.'%');
            }
        })
            ->orderby('id','desc')
            ->paginate(2); //分页
        $data = DB::table('menu_categories')
            ->join('menus','menu_categories.id','=','menus.category_id')
            ->select('menu_categories.name','menus.goods_name','menus.goods_price','menus.status')
            ->get();*/

/*       if($keywords || $start){
           if($keywords && $start){
               //DB::connection()->enableQueryLog();  开启查询日志
               $data = Menu::join('menu_categories',function ($join){
                   $join->on('menu_categories.id','=','menus.category_id');
               })
                   ->where(function ($query) use ($keywords,$start,$end){
                        $query->where('menus.goods_name','like','%'.$keywords.'%')
                            ->where('menus.goods_price','between',[$start,$end]);
                   })
                   ->select('menu_categories.name','menus.goods_name','menus.goods_price','menus.status')
                   ->get();
               //var_dump(DB::getQueryLog()); 获取查询的sql 语句

           }elseif ($keywords){
               $data = Menu::join('menu_categories',function ($join){
                   $join->on('menu_categories.id','=','menus.category_id');
               })
                   ->select('menu_categories.name','menus.goods_name','menus.goods_price','menus.status')
                   ->where('menus.goods_name','like','%'.$keywords.'%')
                   ->get();

           }elseif($start){
               $data = Menu::join('menu_categories',function ($join){
                   $join->on('menu_categories.id','=','menus.category_id');
               })
                   ->whereBetween('menus.goods_price',[$start,$end])
                   ->select('menu_categories.name','menus.goods_name','menus.goods_price','menus.status')
                   ->get();
           }
       }else{
            $data = Menu::join('menu_categories',function ($join){
                $join->on('menu_categories.id','=','menus.category_id');
            })
                ->select('menu_categories.name','menus.goods_name','menus.goods_price','menus.status')
                ->get();
       }*/
        $cateall = MenuCategory::all();
       //var_dump($data);
        return view('menu.list',compact('cateall','data','categoryid'));
    }

    public function create()
    {
        $data = MenuCategory::all();
        return view('menu.create',compact('data'));
    }

    public function store(Request $request,Menu $menu)
    {
        $this->validate($request,[
            'goods_name' => 'required',
            'rating'=>'required',
            'category_id' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'tips' => 'required',
            'status'=>'required',
            'goods_img'=>'required',
        ]);
        $data = [
            'goods_name' => $request->goods_name,
            'shop_id' => auth()->user()->id,
            'rating'=>$request->rating,//菜品评分
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'tips' => $request->tips,
            'status' => $request->status,
            'goods_img'=>$request->goods_img,
        ];
        Menu::create($data);
        return redirect()->route('menus.index')->with('success','增加菜品成功');
    }

    public function edit(Request $request,Menu $menu)
    {
        $cate = MenuCategory::all();
        return view('menu.edit',compact('menu','cate'));
    }

    public function update(Request $request,Menu $menu)
    {
        $this->validate($request,[
            'goods_name' => 'required',
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
            'shop_id' => auth()->user()->id,
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
        return 'success';
        //return redirect()->route('menus.index')->with('success','删除菜品成功');
    }

}
