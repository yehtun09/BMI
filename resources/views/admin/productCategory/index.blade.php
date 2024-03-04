@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class=" font-weight-bold ">{{ trans('cruds.product_category.title_singular') }} {{ trans('global.list') }}
            </h5>

            @can('user_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.product-category.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.product_category.title_singular') }}
                        </a>
                        <a href="{{ route('admin.product-category.showTrash') }}"
                            class="btn btn-primary">{{ trans('cruds.product_category.fields.trash') }}</a>
                    </div>
                </div>
            @endcan
        
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.product_category.fields.no') }}
                            </th>
                            <th>
                                {{ trans('cruds.product_category.fields.name') }}
                            </th>

                            <th>
                                {{ trans('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_categories as $key => $product_category)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $product_category->name ?? '' }}
                                </td>
                                <td>
                                    @can('product_category_show')
                                        <a class="p-0 glow text-white btn btn-primary"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="view"
                                            href="{{ route('admin.product-category.show', $product_category->id) }}">
                                            Show
                                        </a>
                                    @endcan

                                    @can('product_category_edit')
                                        <a class="p-0 glow text-white btn btn-success"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            title="edit"
                                            href="{{ route('admin.product-category.edit', $product_category->id) }}">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('product_category_delete')
                                        <form id="orderDelete-{{ $product_category->id }}"
                                            action="{{ route('admin.product-category.destroy', $product_category->id) }}"
                                            method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" style="width: 60px;display: inline-block;line-height: 36px;"
                                                class=" p-0 glow text-white " value="{{ trans('global.delete') }}">
                                            <button
                                                style="width: 60px;display: inline-block;line-height: 36px;border:none;color:grey;"
                                                class=" p-0 glow text-white btn btn-danger" title="delete"
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
                    {{-- {{ $users->links() }} --}}
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
                bPaginate: false,
                info: false,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
