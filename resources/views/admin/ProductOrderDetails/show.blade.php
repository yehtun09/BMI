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
                            {{ trans('cruds.product_order_details.fields.buyer_id') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->buyer_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.date') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.delivery_address') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->delivery_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order_details.fields.phone') }}
                        </th>
                        <td>
                            {{ $productOrderDetail->phone }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <a class="btn btn-secondary mt-3" href="{{ route('admin.product_order_details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
