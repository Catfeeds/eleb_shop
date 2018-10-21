<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use App\Model\Shops;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
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
        MenuCategory::create($request->input());
        return redirect()->route('menucategories.index')->with('success','添加菜品分类成功');
    }

    public function edit(Request $request,MenuCategory $menucategory)
    {
        return view('menucategory.edit',compact('menucategory'));
    }

    public function update(Request $request,MenuCategory $menucategory)
    {
        $menucategory->update($request->input());
        return redirect()->route('menucategories.index')->with('success','修改菜品分类成功');
    }

    public function destroy(Request $request,MenuCategory $menucategory)
    {
        if(Shops::find($menucategory->shop_id) != 'null' || Menu::where('category_id',$menucategory->id)->first() != 'null'){
            return 1;
        }
        return 2;
        $menucategory->delete();
        return redirect()->route('menucategories.index')->with('success','删除菜品分类成功');
    }
}

