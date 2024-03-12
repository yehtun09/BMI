@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.sellerType.title_singular') }} {{ trans('global.list') }}</h5>

            @can('seller_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">

                        <a class="btn btn-success" href="{{ route('admin.seller-type.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.sellerType.title_singular') }}
                        </a>

                        <a href="{{ route('admin.seller-type.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.product_order.fields.trash')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-SellerType">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.sellerType.fields.no') }}</th>
                            <th>{{ trans('cruds.sellerType.fields.name') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seller_types as $key => $seller_type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $seller_type->name ?? '' }}</td>
                                <td>
                                    @can('seller_type_show')
                                        <a class="p-0 glow text-white btn btn-primary"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.seller-type.show', $seller_type->id) }}">
                                            Show
                                        </a>
                                    @endcan

                                    @can('seller_type_edit')
                                        <a class="p-0 glow text-white btn btn-success"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="edit"
                                            href="{{ route('admin.seller-type.edit', $seller_type->id) }}">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('seller_type_delete')
                                        <form id="sellerTypeDelete-{{ $seller_type->id }}"
                                            action="{{ route('admin.seller-type.destroy', $seller_type->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                style="width: 60px;display: inline-block;line-height: 36px;border:none;color:grey;"
                                                class="p-0 glow text-white btn btn-danger" title="delete"
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
            let table = $('.datatable-SellerType:not(.ajaxTable)').DataTable({
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