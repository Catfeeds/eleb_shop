@extends('layout.default')
@section('contents')
    <script src="/echarts.min.js"></script>
    <table class="table table-bordered">
        <h3>最近一周每个菜品销量</h3>
        <tr>
            <th>菜品名称</th>
            @foreach($week as $date)
                <th>{{ $date }}</th>
            @endforeach
        </tr>
        @foreach($result as $id=>$r)
            <tr>
                <td>{{ $menus[$id] }}</td>
            @foreach($r as $date=>$total)
                <td>{{ $total }}条</td>
            @endforeach
            </tr>
        @endforeach
    </table>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 1000px;height:400px;"></div>
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
                data:@php echo json_encode(array_values($menus)) @endphp
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
                data:@php echo json_encode($week) @endphp
            },
            yAxis: {
                type: 'value'
            },
            series:@php echo json_encode($service) @endphp
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection

