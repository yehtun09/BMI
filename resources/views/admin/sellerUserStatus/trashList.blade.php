@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.sellerUserStatus.title') }} {{ trans('global.list') }}</h5>

            @can('seller_user_status_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.seller-user-statuses.index') }}" class="btn btn-primary">
                            {{ trans('global.back') }}
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-SellerUserStatus">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.sellerUserStatus.fields.id') }}</th>
                            <th>{{ trans('cruds.sellerUserStatus.fields.seller_product_id') }}</th>
                            <th>{{ trans('cruds.sellerUserStatus.fields.user_id') }}</th>
                            <th>{{ trans('cruds.sellerUserStatus.fields.status_id') }}</th>
                            <th>{{ trans('cruds.sellerUserStatus.fields.date') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellerUserStatuses as $key => $status)
                            <tr>
                                <td>{{ $status->id ?? '' }}</td>
                                <td>{{ $status->sellerProduct->sellerProductType->name ?? '' }}</td>
                                <td>{{ $status->user->name ?? '' }}</td>
                                <td>{{ $status->status->name ?? '' }}</td>
                                <td>{{ $status->date ?? '' }}</td>
                                <td>
                                    @can('seller_user_status_show')
                                        <a class="p-0 glow text-white btn btn-primary" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.seller-user-statuses.show', $status->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                @can('product_order_show')
                                    <a class="p-0 glow btn btn-primary text-white" 
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.seller-user-statuses.restore', $status->id) }}">
                                        Restore 
                                    </a>
                                @endcan
                                @can('product_order_delete')
                                    <form id="orderDelete-{{ $status->id }}"
                                        action="{{ route('admin.seller-user-statuses.trashDelete', $status->id) }}" method="POST"
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
                    {{-- {{ $sellerUserStatuses->links() }} --}}
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
            let table = $('.datatable-SellerUserStatus:not(.ajaxTable)').DataTable({
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
