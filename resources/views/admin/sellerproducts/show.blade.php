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
                            {{ trans('cruds.sellerProduct.fields.id') }}
                        </th>
                        <td>
                            {{ $sellerProduct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.seller_product_type_id') }}
                        </th>
                        <td>
                            {{ $sellerProduct->sellerProductType->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.order_date') }}
                        </th>
                        <td>
                            {{ $sellerProduct->order_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.rice_percentage_one') }}
                        </th>
                        <td>
                            {{ $sellerProduct->rice_percentage_one ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.rice_percentage_two') }}
                        </th>
                        <td>
                            {{ $sellerProduct->rice_percentage_two ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.weight') }}
                        </th>
                        <td>
                            {{ $sellerProduct->weight ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.measurement_id') }}
                        </th>
                        <td>
                            {{ $sellerProduct->measurement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.total_amt') }}
                        </th>
                        <td>
                            {{ $sellerProduct->total_amount ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.price') }}
                        </th>
                        <td>
                            {{ $sellerProduct->price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.address') }}
                        </th>
                        <td>
                            {{ $sellerProduct->address ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellerProduct.fields.photo') }}
                        </th>
                        <td>
                            @if ($sellerProduct->photo)
                            <a href="{{ $sellerProduct->photo->getUrl() }}" target="_blank">
                                <img src="{{ $sellerProduct->photo->getUrl('preview') }}" >
                            </a>
                        @endif
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.seller-product.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection