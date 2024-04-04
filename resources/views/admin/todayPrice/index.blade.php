@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.today_price.title') }} {{ trans('global.list') }}</h5>

            @can('today_price_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.today-price.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.today_price.title_singular') }}
                        </a>
                        <a href="{{ route('admin.today-price.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.buyers.fields.trash')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-today_price">
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
                                        <a class="p-0 glow text-white btn btn-primary" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.today-price.show', $today_price->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                    @can('today_price_edit')
                                        <a class="p-0 glow text-white btn btn-success" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.today-price.edit', $today_price->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('today_price_delete')
                                        <form id="deleteForm-{{ $today_price->id }}"
                                            action="{{ route('admin.today-price.destroy', $today_price->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" class="p-0 glow text-white"
                                                value="{{ trans('global.delete') }}">
                                            <button class="p-0 glow text-white btn btn-danger" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                                onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                                {{ trans('global.delete') }}
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
                    {{-- {{ $today_price->links() }} --}}
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
            let table = $('.datatable-today_price:not(.ajaxTable)').DataTable({
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
