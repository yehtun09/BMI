@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold "> {{ trans('cruds.seller.title_singular') }} {{ trans('global.list') }}</h5>
            <div>
                <a href="{{ route('admin.seller.index') }}" class="btn btn-primary">{{ trans('global.back') }}</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-seller">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('global.no') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.name') }}
                            </th>

                            <th>
                                {{ trans('cruds.seller.fields.phone_no') }}
                            </th>

                            <th>
                                {{ trans('cruds.seller.fields.password') }}
                            </th>
                            <th>
                                {{ trans('cruds.seller.fields.address') }}
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
                                    {{ $seller->phone_no ?? '' }}
                                </td>
                               
                                <td>
                                    {{ $seller->password ?? '' }}
                                </td>

                                <td>
                                    {{ $seller->address ?? '' }}
                                </td>
                                <td>
                                    {{ $seller->seller_type_id ?? '' }}
                                </td>
                                <td>

                                    @can('seller_show')
                                        <a class="p-0 glow btn btn-primary text-white"
                                            onclick="return confirm('Are you Sure Restore?')"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.seller.restore.trash', $seller->id) }}">
                                            Restore
                                        </a>
                                    @endcan
                                    @can('seller_delete')
                                        <form id="orderDelete-{{ $seller->id }}"
                                            action="{{ route('admin.seller.trashDelete', $seller->id) }}" method="POST"
                                            style="display: inline-block;">
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
                bPaginate: true,
                info: false,
            });
            let table = $('.datatable-seller:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
