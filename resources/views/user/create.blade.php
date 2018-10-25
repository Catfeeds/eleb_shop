@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
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
        <input type="hidden" name="img" value="" id="img">
        <div class="form-group">
            <label for="">上传店铺图片</label>
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="" alt="" id="huixian" value="{{ old('huixian') }}" name="huixian" height="50px">
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
    <!--引入JS-->
    <script src="/js/jQuery.js"></script>
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf:'/js/Uploader.swf',

            // 文件接收服务端。
            server:"{{ route('elebshop.upload') }}",
            formData:{
                _token:"{{csrf_token()}}"
            },
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        //事件监听
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
                $('#huixian').attr('src',response.url);
                $('#img').val(response.url);
        });
    </script>
@endsection
