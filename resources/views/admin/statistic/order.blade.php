<html>
<head>
    <title>订单统计报表</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/vendor/echarts.min.js') }}"></script>
    <script src="{{ asset('/vendor/iview/vue@2.5.16.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/vendor/iview/iview@3.1.1.css') }}">
    <script src="{{ asset('/vendor/iview/iview@3.1.1.js') }}"></script>
    <script src="{{ asset('/vendor/iview/axios@0.18.0.js') }}"></script>
    <style>

    </style>
</head>
<body>
<div id="app">
    <date-picker v-model="date" format="yyyy/MM/dd" type="daterange" placement="bottom-end" placeholder="Select date" style="width: 200px" @on-change='drawing()'></date-picker>

    <i-select v-model="filterValue" style="width:200px" @on-change='drawing()'>
        <i-option v-for="item in filterType" :value="item.value" :key="item.value">@{{ item.label }}</i-option>
    </i-select>

    <i-select v-model="modelValue" style="width:200px" @on-change='drawing()'>
        <i-option v-for="item in modelType" :value="item.value" :key="item.value">@{{ item.label }}</i-option>
    </i-select>

    <i-select v-model="typeValue" style="width:200px" @on-change='drawing()'>
        <i-option v-for="item in type" :value="item.id" :key="item.id">@{{ item.name }}</i-option>
    </i-select>
</div>
<div>
    <div id="main" style="width: 1200px;height:600px;"></div>
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data: {
                date: [],
                filterType: [
                    {value: '1', label: '彩票张数'},
                    {value: '2', label: '中奖金额'},
                ],
                modelType: [
                    {value: '1', label: '多者全拿'},
                    {value: '2', label: '奖金均分'},
                    {value: '3', label: '少者全拿'}
                ],
                type: [],
                filterValue: '1',
                modelValue: '1',
                typeValue: '',
                //title: '日-多者全拿-大吉大利',
                legend: [],
                chartData: [],
                series: [],
            },
            mounted:function(){
                this.showData()
            },
            methods: {
                showData: function () {
                    var that = this
                    axios.get('/admin/filter/type')
                        .then(function (res) {
                            console.log(res.data)
                            that.type = res.data[1]
                            that.typeValue = res.data[1][0].id
                            that.date = res.data[0]
                            that.drawing()
                        })
                        .catch(function (res) {
                            
                        })
                },
                drawing: function () {
                    var that = this
                    axios.get('/admin/filter/order', {
                        params: {
                            date : that.date,
                            filterValue : that.filterValue,
                            modelValue : that.modelValue,
                            typeValue : that.typeValue
                        }
                    })
                        .then(function (res) {
                            console.log(res.data)
                            that.chartData = res.data[0]
                            that.series = res.data[1]
                            that.show()
                        })
                        .catch(function (res) {

                        })
                },
                show: function () {
                    var that = this
                    var myChart = echarts.init(document.getElementById('main'));

                    var option = {
                        title: {
                            text: that.title
                        },
                        tooltip: {},
                        legend: {
                            data: that.legend
                        },
                        xAxis: {
                            data: that.chartData
                        },
                        yAxis: {},
                        series: that.series
                    };

                    myChart.setOption(option);
                }
            }
        })

    </script>
</div>
</body>
</html>