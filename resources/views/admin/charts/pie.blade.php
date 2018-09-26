<?php $canvasId = rand(1000,20000);?>
<canvas id="{{$canvasId}}" width="500" height="400"></canvas>

<script>
    $(function () {
        var labels = {!! $labels !!}
        var data = {!! $data !!}
        var title  =  "{{$title}}"
        var ctx = document.getElementById({{$canvasId}}).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    label: title,
                    data: data,
                }],
                labels: labels,
            },
        });
    });
</script>