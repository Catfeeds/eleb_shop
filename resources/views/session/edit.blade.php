@extends('layout.default')
@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <form action="{{ route('session.store',['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="">旧密码</label>
            <input type="text" name="oldpassword" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">新密码</label>
            <input type="text" name="password" value=""  class="form-control">
        </div>
        <div class="form-group">
            <label for="">确认密码</label>
            <input type="text" name="repassword" value=""  class="form-control">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" name="email" value="{{ $user->email }}"  class="form-control" disabled="disabled">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">提交</button>
    </form>
@endsection