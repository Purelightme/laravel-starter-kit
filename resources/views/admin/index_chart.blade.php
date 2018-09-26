<div class="" style="display: flex; justify-content: flex-start;flex-wrap: wrap;width: 100%;align-items: center;overflow: scroll">

    <div class="" style="width: 45%;">
        @include('admin.charts.bar',$user)
    </div>

    <div class="" style="width: 45%;">
        @include('admin.charts.line',$user)
    </div>

    <div class="" style="width: 45%;">
        @include('admin.charts.pie',$user)
    </div>

    {{--<div class="" style="width: 45%;">--}}
        {{--@include('admin.charts.bar')--}}
    {{--</div>--}}
</div>