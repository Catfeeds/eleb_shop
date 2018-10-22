<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use App\Model\Shops;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    //中间件验证用户是否登录，登录才可以操作这些方法
    public function __construct()
    {
        $this->middleware('auth',[

        ]);
    }
    public function index()
    {
        $menucategory = MenuCategory::paginate(2);
        return view('menucategory.list',compact('menucategory'));
    }

    public function create()
    {
        return view('menucategory.create');
    }

    public function store(Request $request)
    {

        //验证数据
        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
        ]);
        $data = [
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
            'shop_id'=>auth()->user()->shop_id,
        ];
        MenuCategory::create($data);
        return redirect()->route('menucategories.index')->with('success','添加菜品分类成功');
    }

    public function edit(Request $request,MenuCategory $menucategory)
    {
        return view('menucategory.edit',compact('menucategory'));
    }

    public function update(Request $request,MenuCategory $menucategory)
    {
        $this->validate($request,[
            'name'=>'required',
            'type_accumulation'=>'required',
            'description'=>'required',
            'is_selected'=>'required',
        ]);
        $data = [
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
            'shop_id'=>auth()->user()->shop_id,
        ];
        $menucategory->update($data);
        return redirect()->route('menucategories.index')->with('success','修改菜品分类成功');
    }


    public function destroy(Request $request,MenuCategory $menucategory)
    {
        //只能删除空菜品分类 该菜品分类不属于某个商家，不属于某个菜品，才可以删除
        if(Shops::find($menucategory->shop_id) != null || Menu::where('category_id',$menucategory->id)->first() != null){
            return redirect()->route('menucategories.index')->with('danger','只能删除空菜品分类!');
        }
        $menucategory->delete();
        return redirect()->route('menucategories.index')->with('success','删除菜品分类成功');
    }
}

