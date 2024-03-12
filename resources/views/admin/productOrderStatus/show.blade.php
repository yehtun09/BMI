@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.product_order_status.title_singular') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.id') }}</th>
                            <td>{{ $productOrderStatus->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.product_order_id') }}</th>
                            <td>{{ $productOrderStatus->productOrder->buyer->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.user_id') }}</th>
                            <td>{{ $productOrderStatus->user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.status_id') }}</th>
                            <td>{{ $productOrderStatus->status->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.product_order_status.fields.date') }}</th>
                            <td>{{ $productOrderStatus->date ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.product-order-status.index') }}" class="btn btn-default">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
@endsection
