@extends('layouts.admin')
@section('content')

<div class="card">
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.seller.title') }}
    </h6>
    {{-- <div class="card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.seller.title') }}
    </div> --}}

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.id') }}
                        </th>
                        <td>
                            {{ $productMeasurement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.product_id') }}
                        </th>
                        <td>
                            {{ $productMeasurement->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.price') }}
                        </th>
                        <td>
                            {{ $productMeasurement->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.weight') }}
                        </th>
                        <td>
                            {{ $productMeasurement->weight ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.measurement_id') }}
                        </th>
                        <td>
                            {{ $productMeasurement->measurement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.product_category_id') }}
                        </th>
                        <td>
                            {{ $productMeasurement->productCategory->name ?? '' }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.productMeasurement.fields.image') }}
                        </th>
                        <td>
                            @if ($productMeasurement->photo)
                            <a href="{{ $productMeasurement->photo->getUrl() }}" target="_blank">
                                <img src="{{ $productMeasurement->photo->getUrl('preview') }}" >
                            </a>
                        @endif
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.product-measurements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection