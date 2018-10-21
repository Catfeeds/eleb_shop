@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>菜品名称</td>
            <td>菜品评分</td>
            <td>所属商家</td>
            <td>所属分类ID</td>
            <td>菜品价格</td>
            <td>菜品描述</td>
            <td>菜品月销量</td>
            <td>菜品评分数量</td>
            <td>提示信息</td>
            <td>菜品满意度数量</td>
            <td>满意度评分</td>
            <td>菜品图片</td>
            <td>菜品状态</td>
            <td>操作</td>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->goods_name }}</td>
                <td>{{ $menu->rating }}</td>
                <td>{{ $menu->shop_id }}</td>
                <td>{{ $menu->category_id }}</td>
                <td>{{ $menu->goods_price }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->month_sales }}</td>
                <td>{{ $menu->rating_count }}</td>
                <td>{{ $menu->tips }}</td>
                <td>{{ $menu->satisfy_count }}</td>
                <td>{{ $menu->satisfy_rate }}</td>
                <td>{{ $menu->goods_img }}</td>
                <td>{{ $menu->status }}</td>
                <td>
                    <a href="{{ route('menus.edit',[$menu]) }}" class="btn btn-warning">修改</a>
                    <form action="{{ route('menus.destroy',[$menu]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection


