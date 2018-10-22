@extends('layout.default')
@section('contents')
    <form action="{{ route('menucategories.update',[$menucategory]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜品分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $menucategory->name }}">
        </div>
        <div class="form-group">
            <label for="">菜品分类编号</label>
            <input type="text" name="type_accumulation" class="form-control" value="{{ $menucategory->type_accumulation }}">
        </div>
        <div class="form-group">
            <label for="">菜品分类描述</label>
            <input type="text" name="description" class="form-control" value="{{ $menucategory->description }}">
        </div>
        <div class="form-group">
            <label for="">是否是默认分类</label>
            <input type="text" name="is_selected" class="form-control" value="{{ $menucategory->is_selected }}" >
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">确认修改</button>
    </form>    
@endsection


