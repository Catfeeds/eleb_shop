@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <table class="table table-responsive">
        <tr>
            <td>编号</td>
            <td>菜品分类名称</td>
            <td>菜品编号</td>
            <td>所属商家ID</td>
            <td>描述描述</td>
            <td>是否是默认分类</td>
            <td>操作</td>
        </tr>
        @foreach($menucategory as $menucate)
            <tr>
                <td>{{ $menucate->id }}</td>
                <td>{{ $menucate->name }}</td>
                <td>{{ $menucate->type_accumulation }}</td>
                <td>{{ $menucate->shop_id }}</td>
                <td>{{ $menucate->description }}</td>
                <td>{{ $menucate->is_selected }}</td>
                <td>
                    <a href="{{ route('menucategories.edit',[$menucate])}}" class="btn btn-warning">修改</a>
                    <form action="{{ route('menucategories.destroy',[$menucate]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="bnt btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

