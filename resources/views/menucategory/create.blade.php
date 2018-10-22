@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('menucategories.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜品分类名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">菜品编号</label>
            <input type="text" name="type_accumulation" class="form-control">
        </div>
        <div class="form-group">
            <label for="">描述</label>
            <input type="text" name="description" class="form-control">
        </div>
        <label for="">是否是默认分类</label>
        <div class="form-group">
            <label for="">
                <input type="radio" name="is_selected" value="1">是
            </label>
            <label for="">
                <input type="radio" name="is_selected" value="0">否
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">添加菜品分类</button>
    </form>
@endsection
