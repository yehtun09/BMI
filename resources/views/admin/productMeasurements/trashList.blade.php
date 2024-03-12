@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.productMeasurement.title') }} {{ trans('global.list') }}</h5>

            @can('product_measurement_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.product-measurements.index') }}">
                            {{  trans('global.back') }}
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-ProductMeasurement">
                    <thead>
                        <tr>
                            <th>{{ trans('cruds.productMeasurement.fields.id') }}</th>
                            <th>{{ trans('cruds.productMeasurement.fields.product_id') }}</th>
                            <th>{{ trans('cruds.productMeasurement.fields.measurement_id') }}</th>
                            <th>{{ trans('cruds.productMeasurement.fields.price') }}</th>
                            <th>{{ trans('cruds.productMeasurement.fields.weight') }}</th>
                            <th>{{ trans('cruds.productMeasurement.fields.product_category_id') }}</th>
                            <th>{{ trans('cruds.product.fields.image') }}</th>
                            <th>{{ trans('global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productMeasurements as $key => $productMeasurement)
                            <tr>
                                <td>{{ $productMeasurement->id ?? '' }}</td>
                                <td>{{ $productMeasurement->product->name ?? '' }}</td>
                                <td>{{ $productMeasurement->measurement->name ?? '' }}</td>
                                <td>{{ $productMeasurement->price ?? '' }}</td>
                                <td>{{ $productMeasurement->weight ?? '' }}</td>
                                <td>{{ $productMeasurement->productCategory->name ?? '' }}</td>
                                <td>
                                    @if ($productMeasurement->photo)
                                        <a href="{{ $productMeasurement->photo->getUrl() }}" target="_blank">
                                            <img src="{{ $productMeasurement->photo->getUrl('preview') }}" >
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('product_show')
                                    <a class="p-0 glow btn btn-primary text-white" 
                                        onclick="return confirm('Are you Sure Restore?')"
                                        style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                        title="view" href="{{ route('admin.product-measurements.restore.trash', $productMeasurement->id) }}">
                                        Restore 
                                    </a>
                                @endcan
                                @can('product_delete')
                                    <form id="orderDelete-{{ $productMeasurement->id }}"
                                        action="{{ route('admin.product-measurements.trashDelete', $productMeasurement->id) }}" method="POST"
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
                <div class="mt-3" style="float: right;">
                    {{-- Uncomment the following line for pagination --}}
                    {{-- {{ $productMeasurements->links() }} --}}
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
                bPaginate: false,
                info: false,
            });
            let table = $('.datatable-ProductMeasurement:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
