@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <td>抽奖将活动编号</td>
            <td>活动标题</td>
            <td>活动详情</td>
            <td>报名开始时间</td>
            <td>报名结束时间</td>
            <td>开奖时间</td>
            <td>是否已开奖</td>
            <td>操作</td>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->content }}</td>
                <td>{{ date('Y-m-d H:i:s',$event->signup_start) }}</td>
                <td>{{ date('Y-m-d H:i:s',$event->signup_end) }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->is_prize }}</td>
                <td>
                    @if($event->signup_end > $totime)
                       {{-- @if($eventmembers)--}}
                        <a href="{{ route('events.signup',[$event]) }}" class="btn btn-info">报名</a>
                    @else
                        <a href="{{ route('events.signup',[$event]) }}" class="btn btn-warning disabled">已结束报名</a>
                        <a href="{{ route('events.view',[$event]) }}" class="btn btn-info">查看中奖结果</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
