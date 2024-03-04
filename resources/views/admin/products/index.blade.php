@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product.title') }} {{ trans('global.list') }}</h5>

            @can('product_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                        </a>
                        <a href="{{ route('admin.product.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.buyers.fields.trash')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Product">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.product.fields.id') }}</th>
                            <th>{{ trans('cruds.product.fields.name') }}</th>
                            <th>{{ trans('cruds.product.fields.price') }}</th>
                            <th>{{ trans('cruds.product.fields.weight') }}</th>
                            <th>{{ trans('cruds.product.fields.measurement') }}</th>
                            <th>{{ trans('cruds.product.fields.product_category') }}</th>
                            <th>{{ trans('cruds.product.fields.image') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $product->id ?? ''}}</td>
                                <td>{{ $product->name ?? ''}}</td>
                                <td>{{ $product->price ?? '' }}</td>
                                <td>{{ $product->weight ?? '' }}</td>
                                <td>{{ $product->measurement->name ?? '-' }}</td>
                                <td>{{ $product->productCategory->name ?? '-'  }}</td>
                                <td>
                                    @if ($product->photo)
                                    <a href="{{ $product->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $product->photo->getUrl('preview') }}" >
                                    </a>
                                @endif
                                </td>
                                <td>
                                    @can('product_show')
                                        <a class="p-0 glow text-white btn btn-primary" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.products.show', $product->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                    @can('product_edit')
                                        <a class="p-0 glow text-white btn btn-success" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.products.edit', $product->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_delete')
                                        <form id="deleteForm-{{ $product->id }}"
                                            action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
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
                    {{-- {{ $products->links() }} --}}
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
            let table = $('.datatable-Product:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
