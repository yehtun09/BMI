@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold ">  {{ trans('cruds.buyers.title_singular') }} {{ trans('global.list') }}</h5>
            <div>
                <a href="{{ route('admin.buyers.export', request()->all()) }}"
                    class="btn btn-info ">{{ trans('cruds.buyers.fields.export_excel')}}</a>
               
                <a href="{{ route('admin.buyers.showTrash') }}"
                    class="btn btn-primary">{{ trans('cruds.buyers.fields.trash')}}</a>
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
                                {{ trans('cruds.buyers.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.buyers.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.buyers.fields.phone_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.buyers.fields.buyer_category') }}
                            </th>
                            <th>
                                {{ trans('cruds.buyers.fields.password') }}
                            </th>
                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buyers as $key => $buyer)
                            <tr data-entry-id="{{ $buyer->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $buyer->name ?? '' }}
                                </td>
                                <td>
                                    {{ $buyer->address ?? '' }}
                                </td>
                                <td>
                                    {{ $buyer->phone_no ?? '' }}
                                </td>
                                <td>
                                    {{ config('constant.buyerCategory.' . $buyer->buyer_category, '') }}
                                </td>
                                <td>
                                    {{ $buyer->password ?? '' }}
                                </td>
                                <td>
                                    
                                    @can('buyer_show')
                                        <a class="p-0 glow btn btn-primary text-white"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view" href="{{ route('admin.buyers.show', $buyer->id) }}">
                                            Show
                                        </a>
                                    @endcan

                                    @can('buyer_edit')
                                        <a class="p-0 glow btn btn-success text-white"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="edit" href="{{ route('admin.buyers.edit', $buyer->id) }}">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('buyer_delete')
                                        <form id="orderDelete-{{ $buyer->id }}"
                                            action="{{ route('admin.buyers.destroy', $buyer->id) }}" method="POST"
                                            onsubmit=""
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
                <div class="mt-3" style="float:right;">
                {{-- {{ $buyerss->links( ) }} --}}
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
            @can('buyers_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.buyerss.massDestroy') }}",
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