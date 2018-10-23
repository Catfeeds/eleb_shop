@extends('layout.default')
@section('contents')
    <h1>活动标题：{{ $activity->title }}</h1>
    <div>
        <p>活动内容：{{ $activity->content }}</p>
        <p>活动开始时间：{{$activity->start_time}}</p>
        <p>活动结束时间{{ $activity->end_time}}</p>
    </div>
@endsection