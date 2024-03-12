@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product_order_status.title') }} {{ trans('global.list') }}</h5>

            @can('product_order_status_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.product-order-status.index') }}"
                        class="btn btn-primary">{{ trans('global.back')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Product_order_status">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.id') }}</th>
                            <th>{{ trans('cruds.product_order_status.fields.product_order_id') }}</th>
                            <th>{{ trans('cruds.product_order_status.fields.user_id') }}</th>
                            <th>{{ trans('cruds.product_order_status.fields.status_id') }}</th>
                            <th>{{ trans('cruds.product_order_status.fields.date') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productOrderStatuses as $key => $productOrderStatus)
                            <tr>
                                <td>{{ $productOrderStatus->id }}</td>
                                <td>{{ $productOrderStatus->productOrder->product->name ?? '' }}</td>
                                <td>{{ $productOrderStatus->user->name ?? '' }}</td>
                                <td>{{ $productOrderStatus->status->name ?? '' }}</td>
                                <td>{{ $productOrderStatus->date ?? '' }}</td>
                                <td>
                                @can('product_order_show')
                                    <a class="p-0 glow btn btn-primary text-white" 
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.product-order-status.restore.trash', $productOrderStatus->id) }}">
                                        Restore 
                                    </a>
                                @endcan
                                @can('product_order_delete')
                                    <form id="orderDelete-{{ $productOrderStatus->id }}"
                                        action="{{ route('admin.product-order-status.trashDelete', $productOrderStatus->id) }}" method="POST"
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
                    {{-- {{ $productOrderStatuses->links() }} --}}
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
                bPaginate: true,
                info: false,
            });
            let table = $('.datatable-Product_order_status:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection