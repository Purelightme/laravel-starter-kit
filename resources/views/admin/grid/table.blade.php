<div class="box">
    <div class="box-header">

        <h3 class="box-title"></h3>

        <div class="pull-right">
            {!! $grid->renderFilter() !!}
            {!! $grid->renderExportButton() !!}
            {!! $grid->renderCreateButton() !!}
        </div>

        <span>
            {!! $grid->renderHeaderTools() !!}
        </span>

        <!-- 自定义区 -->
        @if(\Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Route::current()->uri,['admin/channel-manage/order','admin/order']))
            @php
                $totalBuy = 0;
                $totalWin = 0;
                foreach ($grid->rows() as $row){
                   $totalBuy += $row->column('buy_price');
                   $totalWin += $row->column('winning_total_price');
                }
            @endphp
            总消费额：{{ $totalBuy }}元 &nbsp;&nbsp;&nbsp;&nbsp;
            总奖金：{{ $totalWin }}元
        @endif

    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                @foreach($grid->columns() as $column)
                    <th>{{$column->getLabel()}}{!! $column->sorter() !!}</th>
                @endforeach
            </tr>

            @foreach($grid->rows() as $row)
                <tr {!! $row->getRowAttributes() !!}>
                    @foreach($grid->columnNames as $name)
                        <td {!! $row->getColumnAttributes($name) !!}>
                            {!! $row->column($name) !!}
                        </td>
                    @endforeach
                </tr>
            @endforeach

            {!! $grid->renderFooter() !!}

        </table>
    </div>
    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    <!-- /.box-body -->
</div>
