@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('menus.update',[$menu]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜品名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ $menu->goods_name }}">
        </div>
        <div class="form-group">
            <label for="">菜品评分</label>
            <input type="text" name="rating" class="form-control" value="{{ $menu->rating }}">
        </div>
        <div class="form-group">
            <label for="">所属商家</label>
            <input type="text" name="shop_id" class="form-control" value="{{ auth()->user()->name }}">
        </div>
        <div class="form-group">
            <label for="">所属分类ID</label>
            <select name="category_id" id="" class="form-control">
                @foreach($cate as $v)
                    <option @if($menu->categoryid == $v->id) selected="selected" @endif>{{ $v->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">菜品价格</label>
            <input type="text" name="goods_price" class="form-control" value="{{ $menu->goods_price }}">
        </div>
        <div class="form-group">
            <label for="">菜品描述</label>
            <input type="text" name="description" class="form-control" value="{{ $menu->description }}">
        </div>
        <div class="form-group">
            <label for="">菜品月销量</label>
            <input type="text" name="month_sales" class="form-control" value="{{ $menu->month_sales }}">
        </div>
        <div class="form-group">
            <label for="">菜品评分数量</label>
            <input type="text" name="rating_count" class="form-control" value="{{ $menu->rating_count }}">
        </div>
        <div class="form-group">
            <label for="">提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ $menu->tips }}">
        </div>
        <div class="form-group">
            <label for="">菜品满意度数量</label>
            <input type="text" name="satisfy_count" class="form-control" value="{{ $menu->satisfy_count }}">
        </div>
        <div class="form-group">
            <label for="">满意度评分</label>
            <input type="text" name="satisfy_rate" class="form-control" value="{{ $menu->satisfy_rate }}">
        </div>
        <div class="form-group">
            <label for="">菜品图片</label>
            <img src="{{ \Illuminate\Support\Facades\Storage::url($menu->goods_img) }}" alt="">
            <input type="file" name="goods_img">
        </div>
        <div class="form-group">
            <label for="">菜品状态</label>
            <input type="text" name="status" class="form-control" value="{{ $menu->status }}">
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">添加菜品</button>
    </form>
@endsection
