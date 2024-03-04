@extends('layouts.admin')
@section('content')

<div class="card">
   
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.product_order.title') }}
    </h6>

    <div class="card-body">
        <div class="form-group">
           
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.id') }}
                        </th>
                        <td>
                            {{ $product_order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.product_id') }}
                        </th>
                        <td>
                            {{ $product_order->product->name ?? ' ' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.buyer_id') }}
                        </th>
                        <td>
                            {{ $product_order->buyer->name ?? ' ' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.order_date') }}
                        </th>
                        <td>
                            {{ $product_order->order_date ?? ' ' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.qty') }}
                        </th>
                        <td>
                            {{ $product_order->qty ?? ' '}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.total_amount') }}
                        </th>
                        <td>
                            {{ $product_order->total_amount ?? ' '}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.delivery_address') }}
                        </th>
                        <td>
                            {{ $product_order->delivery_address ?? ' ' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $product_order->phone_no ?? ' '}}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.product_order.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $product_order->name }}
                        </td>
                    </tr> --}}
                   
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary mt-3" href="{{ route('admin.product-order.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#service_person_service_assigns" role="tab" data-toggle="tab">
                {{ trans('cruds.serviceAssign.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="service_person_service_assigns">
            @includeIf('admin.users.relationships.servicePersonServiceAssigns', ['serviceAssigns' => $user->servicePersonServiceAssigns])
        </div>
    </div>
</div> --}}

@endsection
