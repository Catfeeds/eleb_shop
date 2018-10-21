@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">名称</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">确认密码</label>
            <input type="password" name="repassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" name="email" class="form-control" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="">店铺分类</label>
            <input type="text" name="shop_category_id" class="form-control" value="{{old('shop_category_id')}}">
        </div>
        <div class="form-group">
            <label for="">店铺名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{old('shop_name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">上传店铺图片</label>
            <input type="file" id="exampleInputFile" name="shop_img">
            <p class="help-block">Example block-level help text here.</p>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="brand" value="1"> 是否品牌
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="on_time" value="1"> 是否准时达
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fengniao" value="1"> 是否支持蜂鸟配送
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="piao" value="1"> 是否票标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="zhun" value="1"> 是否准标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="bao" value="1"> 是否保标记
            </label>
        </div>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        <button class="btn btn-info">注册</button>
    </form>
@endsection
