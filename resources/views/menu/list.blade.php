@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <form class="navbar-form navbar-left form-box" action="{{ route('menus.index') }}" style="display: block" method="post">
        <input type="hidden" name="cateid" value="@if($categoryid) {{ $categoryid }} @else 0 @endif">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="keywords" >
        </div>
        <label for="">价格区间</label>
        <div class="form-group">
            <label for="">开始</label>
            <input type="text" name="start" class="form-control">
        </div>
        <div class="form-group">
            <label for="">结束</label>
            <input type="text" name="end" class="form-control">
        </div>
        {{ method_field('GET') }}
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <ul class="list-unstyled" style="display: block">
        @foreach($cateall as $cate)
            <li><a href="{{ route('menus.index',['cateid'=>$cate->id]) }}">{{ $cate->name}}</a></li>
        @endforeach
    </ul>
    <table class="table table-bordered">
        <tr>
            <td>菜品名称</td>
            <td>菜品价格</td>
            <td>菜品状态</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{ $v->goods_name }}</td>
                <td>{{ $v->goods_price }}</td>
                <td>{{ $v->goods_status }}</td>
                <td>
                    <a href="{{route('menus.edit',[$v])}}" class="btn btn-warning">修改</a>
                    <a href="javascript:;" data-href="{{ route('menus.destroy',[$v]) }}" class="del_btn btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    <script src="/js/jQuery.js"></script>
    <script>
        $('.del_btn').click(function(){
            var btn= $(this);
            var url = btn.data('href');
            if(confirm('你确定要删除么？删除之后不可恢复！')){
                $.ajax({
                    type:"DELETE",
                    url:url,
                    data:{
                        _token:"{{ csrf_token() }}"
                    },
                    //成功之后执行的函数
                    success:function(msg){
                        if(msg == 'success'){
                            alert('删除成功');
                            btn.closest('tr').fadeout();
                        }else{
                            alert('删除失败');
                        }
                    }
                });
            }
        });
    </script>
@endsection
