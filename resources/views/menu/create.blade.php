@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜品名称</label>
            <input type="text" name="goods_name" class="form-control" value="{{ old('goods_name') }}">
        </div>
        <div class="form-group">
            <label for="">菜品评分</label>
            <input type="text" name="rating" class="form-control" value="{{ old('rating') }}">
        </div>
        <div class="form-group">
            <label for="">请选择菜品分类</label>
            <select name="category_id" id="" class="form-control">
                @foreach($data as $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">菜品价格</label>
            <input type="text" name="goods_price" class="form-control" value="{{ old('goods_price') }}">
        </div>
        <div class="form-group">
            <label for="">菜品描述</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label for="">提示信息</label>
            <input type="text" name="tips" class="form-control" value="{{ old('tips') }}">
        </div>
        <div class="form-group">
            <label for="">菜品图片</label>
            <input type="file" name="goods_img">
        </div>
        <label for="">菜品状态</label>
        <div class="form-group">
            <label for="">
                <input type="radio" name="status" value="1">上架
            </label>
            <label for="">
                <input type="radio" name="status" value="2">下架
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">添加菜品</button>
    </form>
@endsection
