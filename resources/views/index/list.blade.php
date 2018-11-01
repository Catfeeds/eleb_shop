@extends('layout.default')
@section('contents')
    <script src="/echarts.min.js"></script>
    {{--<h3>最近七天的每天订单数量统计</h3>
    <table class="table table-responsive">
            <tr>
                @foreach($orders as $order)
                    <td>{{ $order->riqi }}</td>
                @endforeach
            </tr>
            <tr>
            @foreach($orders as $order)
                <td>{{ $order->count }}条</td>
            @endforeach
            </tr>
    </table>--}}
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 600px;height:400px;"></div>
    <script type="text/javascript">
        function timeFormatter(value) {

            var da = new Date(parseInt(value.replace("/Date(", "").replace(")/" , "").split( "+")[0]));

            return da.getFullYear() + "-" + (da.getMonth() + 1) + "-" + da.getDate() + " " + da.getHours() + ":" + da.getMinutes() + ":" + da.getSeconds();

        }
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '订单走势图'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['订单走势']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data:{{ json_encode($arr) }}
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'订单走势',
                    type:'line',
                    stack: '总量',
                    data:[]
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection
