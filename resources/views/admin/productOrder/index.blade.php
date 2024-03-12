@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.product_order.title') }} {{ trans('global.list') }}</h5>

            @can('product_order_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        {{-- <a class="btn btn-success" href="{{ route('admin.product-order.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.product_order.title_singular') }}
                        </a> --}}
                        <a href="{{ route('admin.product-order.showTrash') }}"
                            class="btn btn-primary">{{ trans('cruds.product_order.fields.trash') }}</a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Product_order">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.product_order.fields.no') }}</th>
                            {{-- <th>{{ trans('cruds.product_order.fields.product_id') }}</th> --}}
                            <th>{{ trans('cruds.product_order.fields.buyer_id') }}</th>
                            <th>{{ trans('cruds.product_order.fields.order_date') }}</th>
                            {{-- <th>{{ trans('cruds.product_order.fields.qty') }}</th>
                            <th>{{ trans('cruds.product_order.fields.total_amount') }}</th> --}}
                            <th>{{ trans('cruds.product_order.fields.delivery_address') }}</th>
                            <th>{{ trans('cruds.product_order.fields.phone_no') }}</th>
                            <th>{{ trans('cruds.product_order.fields.status') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_orders as $key => $product_order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $product_order->product->name ?? '' }}</td> --}}
                                <td>{{ $product_order->buyer->name ?? '' }}</td>
                                <td>
                                    @if ($product_order->order_date)
                                        {{ is_string($product_order->order_date) ? \Carbon\Carbon::parse($product_order->order_date)->format('Y-m-d') : $product_order->order_date->format('Y-m-d') }}
                                    @endif
                                </td>
                                {{-- <td>{{ $product_order->qty ?? '-' }}</td>
                                <td>{{ $product_order->total_amount ?? ' ' }}</td> --}}
                                <td>{{ $product_order->delivery_address ?? ' ' }}</td>
                                <td>{{ $product_order->phone_no ?? ' ' }}</td>
                                {{-- @dd($product_order->productOrderStatues[0]->status->name) --}}
                                <td>
                                    @php
                                        $statusName = $product_order->productOrderStatues[0]->status->name ?? '-';
                                        // dd($statusName);
                                        $badgeClass = $statusName === 'Pending' ? 'bg-secondary' : 'bg-success';
                                    @endphp
                                    <span
                                        class="badge {{ $badgeClass }}">{{ $product_order->productOrderStatues[0]->status->name ?? '-' }}</span>
                                </td>
                                <td>
                                    @can('product_order_show')
                                        <a class="p-0 glow text-white btn btn-primary"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-order.show', $product_order->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                    @can('product_order_edit')
                                        <a class="p-0 glow text-white btn btn-success"
                                            style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-order.edit', $product_order->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_order_delete')
                                        <form id="deleteForm-{{ $product_order->id }}"
                                            action="{{ route('admin.product-order.destroy', $product_order->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" class="p-0 glow text-white"
                                                value="{{ trans('global.delete') }}">
                                            <button class="p-0 glow text-white btn btn-danger"
                                                style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                                onclick="return confirm('{{ trans('global.areYouSure') }}');">
                                                {{ trans('global.delete') }}
                                            </button>
                                        </form>
                                    @endcan

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info text-center"
                                        style="width: 75px;line-height: 33px;" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        Status
                                    </button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="required"
                                                        for="statues">{{ trans('cruds.product_order.fields.status') }}</label>
                                                    <select class=" mb-3"
                                                        aria-label="form-select-lg example" name="statues"
                                                        id="statues">
                                                        <option selected value="">Open Select</option>
                                                        @foreach ($statues as $key => $status)
                                                            <option value="{{ $status->id }}">
                                                                {{ $status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="statues"></span>
                                                    @if ($errors->has('statues'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('statues') }}
                                                        </div>
                                                    @endif    
                                                    </div>
        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @can('product_order_edit')
                                    <form 
                                        style="display: inline-block;">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                          </select>
                                    </form>
                                @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3" style="float: right;">
                    {{-- Uncomment the following line for pagination --}}
                    {{-- {{ $product_orders->links() }} --}}
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
            let table = $('.datatable-Product_order:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
