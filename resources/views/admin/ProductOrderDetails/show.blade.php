@extends('layouts.admin')

@section('content')

<div class="card">
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.product_order_details.title_singular') }}
    </h6>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.id') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.product_order_id') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->productOrder->buyer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.product_id') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.measurement_id') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->measurement->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.total_amount') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->total_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.qty') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->qty }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <a class="btn btn-secondary mt-3" href="{{ route('admin.product-order-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
