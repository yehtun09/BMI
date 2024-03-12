@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.sellerProduct.title') }} {{ trans('global.list') }}</h5>

            @can('seller_product_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a href="{{ route('admin.seller-product.index') }}"
                        class="btn btn-primary">{{ trans('global.back')}}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-SellerProduct">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.sellerProduct.fields.id') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.seller_product_type_id') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.order_date') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.rice_percentage_one') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.rice_percentage_two') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.weight') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.measurement_id') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.total_amt') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.price') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.address') }}</th>
                            <th>{{ trans('cruds.sellerProduct.fields.photo') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellerProducts as $key => $product)
                            <tr>
                                <td>{{ $product->id ?? '' }}</td>
                                <td>{{ $product->sellerProductType->name ?? '' }}</td>
                                <td>{{ $product->order_date ?? '' }}</td>
                                <td>{{ $product->rice_percentage_one ?? '' }}</td>
                                <td>{{ $product->rice_percentage_two ?? '' }}</td>
                                <td>{{ $product->weight ?? '' }}</td>
                                <td>{{ $product->measurement->name ?? '' }}</td>
                                <td>{{ $product->total_amount ?? '' }}</td>
                                <td>{{ $product->price ?? '' }}</td>
                                <td>{{ $product->address ?? '' }}</td>
                                <td>
                                    @if ($product->photo)
                                    <a href="{{ $product->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $product->photo->getUrl('preview') }}" >
                                    </a>
                                @endif
                                </td>
                                <td>
                                    @can('seller_product_create')
                                    <a class="p-0 glow btn btn-primary text-white"
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.seller-product.restore', $product->id) }}">
                                        Restore
                                    </a>
                                @endcan
                                @can('seller_product_delete')
                                    <form id="orderDelete-{{ $product->id }}"
                                        action="{{ route('admin.seller-product.trashDelete', $product->id) }}" method="POST"
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
                bPaginate: true,
                info: false,
            });
            let table = $('.datatable-SellerProduct:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection