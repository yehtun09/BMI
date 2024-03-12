@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.sellerUserStatus.title') }} {{ trans('global.list') }}</h5>

            @can('seller_user_status_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.seller-user-statuses.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.sellerUserStatus.title_singular') }}
                        </a>
                        <a href="{{ route('admin.seller-user-statuses.trash') }}" class="btn btn-primary">
                            {{ trans('cruds.sellerUserStatus.trash_title') }}
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

                                    @can('seller_user_status_edit')
                                        <a class="p-0 glow text-white btn btn-success" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.seller-user-statuses.edit', $status->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('seller_user_status_delete')
                                        <form id="deleteForm-{{ $status->id }}"
                                            action="{{ route('admin.seller-user-statuses.destroy', $status->id) }}" method="POST"
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
