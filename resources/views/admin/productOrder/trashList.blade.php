@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product_order.title') }} {{ trans('global.list') }}</h5>

            @can('product_order_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.product-order.index') }}"
                        class="btn btn-primary">{{ trans('global.back')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Product">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.product_order.fields.no') }}</th>
                            {{-- <th>{{ trans('cruds.product_order.fields.product_id') }}</th> --}}
                            <th>{{ trans('cruds.product_order.fields.buyer_id') }}</th>
                            <th>{{ trans('cruds.product_order.fields.order_date') }}</th>
                            {{-- <th>{{ trans('cruds.product_order.fields.qty') }}</th>
                            <th>{{ trans('cruds.product_order.fields.total_amount') }}</th> --}}
                            <th>{{ trans('cruds.product_order.fields.delivery_address') }}</th>
                            <th>{{ trans('cruds.product_order.fields.phone_no') }}</th>
                            <th>{{ trans('global.action') }}</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_orders as $key => $product_order)
                            <tr>
                                <td>{{ $product_order->id ?? ''}}</td>
                                {{-- <td>{{ $product_order->product->name ?? '' }}</td> --}}
                                <td>{{ $product_order->buyer->name ?? '' }}</td>
                                <td>
                                    @if ($product_order->order_date)
                                        {{ is_string($product_order->order_date) ? \Carbon\Carbon::parse($product_order->order_date)->format('Y-m-d') : $product_order->order_date->format('Y-m-d') }}
                                    @endif
                                </td>
                                {{-- <td>{{ $product_order->qty ?? '-' }}</td>
                                <td>{{ $product_order->total_amount ?? ' ' }}</td> --}}
                                <td>{{ $product_order->delivery_address ?? ' ' }}</td>
                                <td>{{ $product_order->phone_no ?? ' ' }}</td>
                                <td>
                                    @can('product_order_show')
                                    <a class="p-0 glow btn btn-primary text-white" 
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.product-order.restore.trash', $product_order->id) }}">
                                        Restore 
                                    </a>
                                @endcan
                                @can('product_order_delete')
                                    <form id="orderDelete-{{ $product_order->id }}"
                                        action="{{ route('admin.product-order.trashDelete', $product_order->id) }}" method="POST"
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
                    {{-- {{ $products->links() }} --}}
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
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.users.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    //[1, 'desc']
                ],
                pageLength: 100,
                bPaginate: false,
                info: false,
            });
            let table = $('.datatable-Product:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
