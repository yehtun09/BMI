@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product_order_details.title') }} {{ trans('global.list') }}</h5>

            @can('product_order_details_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.product-order-details.index') }}"
                            class="btn btn-primary">{{ trans('global.back') }}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Product_order_details">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.product_order_details.fields.id') }}</th>
                            <th>{{ trans('cruds.product_order_details.fields.product_order_id') }}</th>
                            <th>{{ trans('cruds.product_order_details.fields.product_id') }}</th>
                            
                            <th>{{ trans('cruds.product_order_details.fields.qty') }}</th>
                            <th>{{ trans('cruds.product_order_details.fields.total_amount') }}</th>
                            <th>{{ trans('cruds.product_order_details.fields.measurement_id') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productOrderDetails as $key => $productOrderDetail)
                            <tr>
                                <td>{{ $productOrderDetail->id }}</td>
                                <td>{{ $productOrderDetail->product_order_id }}</td>
                                <td>{{ $productOrderDetail->product_id }}</td>
                                <td>{{ $productOrderDetail->qty }}</td>
                                <td>{{ $productOrderDetail->total_amount }}</td>
                                <td>{{ $productOrderDetail->measurement->name }}</td>
                                <td>
                                    @can('product_order_details_show')
                                    <a class="p-0 glow btn btn-primary text-white" 
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.product-order-details.restore.trash', $productOrderDetail->id) }}">
                                        Restore 
                                    </a>
                                @endcan
                                @can('product_order_details_delete')
                                    <form id="orderDelete-{{ $productOrderDetail->id }}"
                                        action="{{ route('admin.product-order-details.trashDelete', $productOrderDetail->id) }}" method="POST"
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
            let table = $('.datatable-Product_order_details:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
