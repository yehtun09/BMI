@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold "> {{ trans('cruds.seller_product_type.title_singular') }} {{ trans('global.list') }}</h5>

            @can('seller_product_type_access')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.seller-product-type.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.seller_product_type.title_singular') }}
                        </a>
                        <a class="btn btn-primary" href="{{ route('admin.seller-product-type.showTrash') }}">
                            {{ trans('cruds.seller_product_type.fields.trash') }}
                        </a>
                    </div>
                </div>
            @endcan
        </div>
        <div class="card-body table-responsive">
            <table id="tree-table" class="table table-bordered table-striped table-hover datatable datatable-Budget-Title ">
                <thead class="text-center">

                    <th>
                        {{ trans('cruds.seller_product_type.fields.no') }}
                    </th>
                    <th>
                        {{ trans('cruds.seller_product_type.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.seller_product_type.fields.seller_product_category') }}
                    </th>

                    <th>
                        Action
                    </th>
                </thead>

                <tbody id="tableBody">
                    @foreach ($seller_product_types as $key => $seller_product_type)
                        <tr data-id="{{ $key }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $seller_product_type->name ?? '' }}</td>

                            <td>{{ $seller_product_type->sellerProductCategory->name ?? '' }}</td>
                            <td>
                                @can('seller_product_type_show')
                                    <a class="p-0 glow btn btn-primary text-white"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;" title="view"
                                        href="{{ route('admin.seller-product-type.show', $seller_product_type->id) }}">
                                        Show
                                    </a>
                                @endcan

                                @can('seller_product_type_edit')
                                    <a class="p-0 glow btn btn-success text-white"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;" title="view"
                                        href="{{ route('admin.seller-product-type.edit', $seller_product_type->id) }}">
                                        Edit
                                    </a>
                                @endcan

                                @can('seller_product_type_delete')
                                    <form action="{{ route('admin.seller-product-type.destroy', $seller_product_type->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button style="width: 60px;display: inline-block;line-height: 36px;"
                                            class=" p-0 glow btn btn-danger text-white" title="delete">
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
            let table = $('.datatable-Budget-Title:not(.ajaxTable)').DataTable({
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
