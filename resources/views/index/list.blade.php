@extends('layout.default')
@section('contents')
    <script src="/echarts.min.js"></script>
    <h3>最近七天的每天订单数量统计</h3>
    <table class="table table-responsive">
            <tr>
                @foreach($result as $riqi=>$count)
                    <td>{{ $riqi }}</td>
                @endforeach
            </tr>
            <tr>
                @foreach($result as $riqi=>$count)
                    <td>{{ $count }}条</td>
                @endforeach
            </tr>
    </table>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 800px;height:400px;"></div>
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
                text: ''
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
                data:@php echo json_encode(array_keys($result)) @endphp
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'订单走势',
                    type:'line',
                    stack: '总量',
                    data:@php echo json_encode(array_values($result)) @endphp
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    <h3>最近三月订单统计</h3>
    <table class="table table-responsive">
        <tr>
            @foreach($yue_or as $yuefen=>$jishu)
                <th>{{ $yuefen }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($yue_or as $yuefen=>$jishu)
                <td>{{ $jishu }}条</td>
            @endforeach
        </tr>

    </table>

    <div id="yue_order" style="width: 600px;height:400px;"></div>
    <script type="text/javascript">
        function timeFormatter(value) {

            var da = new Date(parseInt(value.replace("/Date(", "").replace(")/" , "").split( "+")[0]));

            return da.getFullYear() + "-" + (da.getMonth() + 1) + "-" + da.getDate() + " " + da.getHours() + ":" + da.getMinutes() + ":" + da.getSeconds();

        }
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('yue_order'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: ''
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
                data:@php echo json_encode(array_keys($yue_or)) @endphp
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'订单走势',
                    type:'line',
                    stack: '总量',
                    data:@php echo json_encode(array_values($yue_or)) @endphp
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>

@endsection
