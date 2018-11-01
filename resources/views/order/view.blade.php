@extends('layout.default')
@section('contents')
    <div>
        <h1>订单id:{{ $id->id }}</h1>
        <h1>订单用户:{{ $id->user_id }}</h1>
        <h1>订单商家:{{ $id->shop_id }}</h1>
        <h1>订单编号:{{ $id->sn }}</h1>
        <h1>省:{{ $id->province }}</h1>
        <h1>市:{{ $id->city }}</h1>
        <h1>区:{{ $id->county }}</h1>
        <h1>价格:{{ $id->total }}</h1>
        <h1>联系电话:{{ $id->tel }}</h1>
        <h1>联系人姓名:{{ $id->name }}</h1>
    </div>
@endsection

