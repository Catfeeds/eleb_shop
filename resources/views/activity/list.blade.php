@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>活动标题</td>
            <td>活动内容</td>
            <td>活动开始时间</td>
            <td>活动结束时间</td>
        </tr>
        @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td><a href="{{ route('activity.view',[$activity]) }}">{{ $activity->title }}</a></td>
                {{--去掉 HTML 及 PHP 的标记--}}
                <td>{!! $activity->content !!}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
            </tr>
        @endforeach
    </table>
    {{ $activities->links() }}
@endsection

