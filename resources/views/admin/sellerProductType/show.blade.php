
@extends('layouts.admin')
@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.seller_product_type.title') }}
        </h6>
        <div class="card-body">
            <div class="form-group">
                
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.seller_product_type.fields.id') }}
                            </th>
                            <td>
                                {{ $seller_product_type->id ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.seller_product_type.fields.name') }}
                            </th>
                            <td>
                                {{ $seller_product_type->name ?? '' }}
                            </td>
                        </tr>
                        
                        <tr>
                            <th>
                                {{ trans('cruds.seller_product_type.fields.seller_product_category') }}
                            </th>
                            <td>
                                {{ $seller_product_type->sellerProductCategory->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group ">
                    <a class="btn btn-secondary mt-3" href="{{ route('admin.seller-product-type.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
