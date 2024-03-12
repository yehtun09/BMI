@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold "> {{ trans('cruds.seller.title_singular') }} {{ trans('global.list') }}</h5>

            {{-- <a href="{{ route('admin.seller.export', request()->all()) }}"
                    class="btn btn-info ">{{ trans('cruds.seller.fields.export_excel')}}</a> --}}
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    @can('seller_create')
                        <a class="btn btn-success" href="{{ route('admin.seller.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.seller.title_singular') }}
                        </a>
                    @endcan
                    <a href="{{ route('admin.seller.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.seller.fields.trash') }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-buyer">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('global.no') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.phone_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.password') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.seller_type_id') }}
                            </th>
                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $key => $seller)
                            <tr data-entry-id="{{ $seller->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $seller->name ?? '' }}
                                </td>
                                <td>
                                    {{ $seller->address ?? '' }}
                                </td>
                                <td>
                                    {{ $seller->phone_no ?? '' }}
                                </td>
                                <td>
                                    {{ $seller->password ?? '' }}
                                </td>
                                <td>
                                    {{ $seller->sellerType->name ?? '' }}
                                </td>
                                <td>

                                    @can('seller_show')
                                        <a class="p-0 glow btn btn-primary text-white"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.seller.show', $seller->id) }}">
                                            Show
                                        </a>
                                    @endcan

                                    @can('seller_edit')
                                        <a class="p-0 glow btn btn-success text-white"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="edit" href="{{ route('admin.seller.edit', $seller->id) }}">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('seller_delete')
                                        <form id="orderDelete-{{ $seller->id }}"
                                            action="{{ route('admin.seller.destroy', $seller->id) }}" method="POST"
                                            onsubmit="" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" style="width: 60px;display: inline-block;line-height: 36px;"
                                                class=" p-0 glow" value="{{ trans('global.delete') }}">
                                            <button style="width: 60px;display: inline-block;line-height: 36px;border:none;"
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
                <div class="mt-3" style="float:right;">
                    {{-- {{ $sellers->links( ) }} --}}
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
            @can('seller_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.seller.massDestroy') }}",
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
                bPaginate:true,
                info:false,
            });
            let table = $('.datatable-buyer:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
