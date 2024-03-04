@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product_order_status.title') }} {{ trans('global.list') }}</h5>

            @can('product_order_status_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.product-order-status.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.product_order.fields.trash')}}</a>
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
                                    @can('product_order_status_show')
                                        <a class="p-0 glow text-white btn btn-primary"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-order-status.show', $productOrderStatus->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                    @can('product_order_status_edit')
                                        <a class="p-0 glow text-white btn btn-success"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-order-status.edit', $productOrderStatus->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_order_status_delete')
                                        <form id="deleteForm-{{ $productOrderStatus->id }}"
                                            action="{{ route('admin.product-order-status.destroy', $productOrderStatus->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <button class="p-0 glow text-white btn btn-danger"
                                                style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
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
