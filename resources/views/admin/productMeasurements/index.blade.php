@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="custom-header">
            <h5 class="font-weight-bold">{{ trans('cruds.productMeasurement.title') }} {{ trans('global.list') }}</h5>

            @can('product_measurement_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('admin.product-measurements.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.productMeasurement.title_singular') }}
                        </a>
                        <a href="{{ route('admin.product-measurements.showTrash') }}"
                        class="btn btn-primary">{{ trans('cruds.buyers.fields.trash')}}</a>
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
                                    @can('product_measurement_show')
                                        <a class="p-0 glow text-white btn btn-primary" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-measurements.show', $productMeasurement->id) }}">
                                            {{ trans('global.show') }}
                                        </a>
                                    @endcan

                                    @can('product_measurement_edit')
                                        <a class="p-0 glow text-white btn btn-success" style="width: 60px;display: inline-block;line-height: 36px;color:grey;"
                                            href="{{ route('admin.product-measurements.edit', $productMeasurement->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_measurement_delete')
                                        <form id="deleteForm-{{ $productMeasurement->id }}"
                                            action="{{ route('admin.product-measurements.destroy', $productMeasurement->id) }}" method="POST"
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
                bPaginate: true,
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
