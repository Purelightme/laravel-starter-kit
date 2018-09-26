<?php $canvasId = rand(1000,20000);?>
<div style="width: 800px;height: 600px">
<canvas id="{{$canvasId}}" width="500" height="400"></canvas>

<script>
    level = 1;

    function checkLevel(arr){
        for (i=0;i<arr.length;i++){
            if(arr[i] instanceof Array){
                level++;
            }
        }
        return level - 1;
    }

    function getColor(last1,last2,last3,i){
        switch (i){
            case 0:
                return [last1,last2,last3];
            case 1:
                return [last1+100,last2,last3];
            case 2:
                return [last1,last2+100,last3];
            case 3:
                return [last1,last2,last3+100];
            default:
                return [last1+i*20,last2+i*30,last3+i*40];
        }
    }

    $(function () {
        var color1 = 66;
        var color2 = 75;
        var color3 = 154;
        var labels = {!! $labels !!}
        var data = {!! $data !!}
        var titles  =  {!! $titles !!}
        var ctx = document.getElementById({{$canvasId}}).getContext('2d');
        level = checkLevel(data);
        if (level > 1){
            datasets = [];
            for (i =0;i < level;i++){
                color = getColor(color1,color2,color3,i);
                console.log(color[0],color[1],color[2])
                datasets.push({
                    label: titles[i],
                    data: data[i],
                    backgroundColor: `rgba(${color[0]},${color[1]},${color[2]},0.5)`,
                    borderColor: "rgba(100,100,100,0.5)",
                    borderWidth: 1
                })
            }
            chartData = {
                labels: labels,
                datasets: datasets
            }
        } else {
            chartData = {
                labels: labels,
                datasets: [{
                    label: titles[0],
                    data: data,
                    backgroundColor: `rgba(${color1},${color2},${color3},0.5)`,
                    borderColor: "rgba(100,100,100,0.5)",
                    borderWidth: 1
                }]
            }
        }
        var myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
</script>
</div>