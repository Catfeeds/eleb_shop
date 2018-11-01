@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <table class="table table-responsive">
        <tr>
            <td>订单编号</td>
            <td>用户ID</td>
            <td>商家ID</td>
            <td>订单sn</td>
            <td>省</td>
            <td>市</td>
            <td>县</td>
            <td>详细地址</td>
            <td>收货人电话</td>
            <td>收货人姓名</td>
            <td>价格</td>
            <td>订单状态</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->shop_id }}</td>
                <td>{{ $order->sn }}</td>
                <td>{{ $order->province }}</td>
                <td>{{ $order->city }}</td>
                <td>{{ $order->county }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a href="{{ route('order.view',[$order]) }}" class="btn btn-info">查看订单</a>
                {{--状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)--}}
                    <a href="{{ route('order.cancel',[$order]) }}" class="btn btn-danger">取消订单</a>
                    <a href="{{ route('order.send',[$order]) }}" class="btn btn-warning">发货</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection