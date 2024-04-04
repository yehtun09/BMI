@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.today_price.title') }} {{ trans('global.list') }}</h5>

            @can('today_price_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.today-price.index') }}" class="btn btn-primary">
                            {{ trans('global.back') }}
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-TodayPriceStatus">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.today_price.fields.id') }}</th>
                            <th>{{ trans('cruds.today_price.fields.date') }}</th>
                            <th>{{ trans('cruds.today_price.fields.type') }}</th>
                            <th>{{ trans('cruds.today_price.fields.buy_price') }}</th>
                            <th>{{ trans('cruds.today_price.fields.sell_price') }}</th>
                            <th>{{ trans('cruds.today_price.fields.rice') }}</th>
                            <th>{{ trans('cruds.today_price.fields.remark') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($today_price as $key => $today_price)
                            <tr>
                                <td>{{ $today_price->id ?? '' }}</td>
                                <td>{{ $today_price->date ?? '' }}</td>
                                <td>{{ $today_price->type ?? '' }}</td>
                                <td>{{ $today_price->buy_price ?? '' }}</td>
                                <td>{{ $today_price->sell_price ?? '' }}</td>
                                <td>{{ $today_price->rice ?? '' }}</td>
                                <td>{{ $today_price->remark ?? '' }}</td>
                                <td>

                                @can('today_price_show')
                                    <a class="p-0 glow btn btn-primary text-white"
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.today-price.restore.trash', $today_price->id) }}">
                                        Restore
                                    </a>
                                @endcan
                                @can('today_price_delete')
                                    <form id="orderDelete-{{ $today_price->id }}"
                                        action="{{ route('admin.today-price.trashDelete', $today_price->id) }}" method="POST"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden"
                                            style="width: 60px;display: inline-block;line-height: 36px;"
                                            class=" p-0 glow" value="{{ trans('global.delete') }}">
                                        <button
                                            style="width: 60px;display: inline-block;line-height: 36px;border:none;"
                                            class=" p-0 glow btn btn-danger text-white" title="delete"
                                            onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="float: right;">
                    {{-- Uncomment the following line for pagination --}}
                    {{-- {{ $TodayPrice->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    //[1, 'desc']
                ],
                pageLength: 100,
                bPaginate: true,
                info: true,
            });
            let table = $('.datatable-TodayPrice:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
        $(() => {
            var flatpickrDate = document.querySelector('#flatpickr-range');

            if (flatpickrDate) {
                flatpickrDate.flatpickr({
                    monthSelectorType: 'static',
                    mode: "range",
                    dateFormat: "d/m/Y",
                });
            }

        })
    </script>
@endsection
