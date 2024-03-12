@extends('layouts.admin')
@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.SellerProductCategory.title') }}
        </h6>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped table-responsive ">
                    <tbody >
                        <tr>
                            <th class="col-3 ">
                                {{ trans('cruds.SellerProductCategory.fields.id') }}
                            </th>
                            <td>
                                {{ $productCategory->id }}
                            </td>
                        </tr>
                        <tr>
                            <th class="col-3 ">
                                {{ trans('cruds.SellerProductCategory.fields.name') }}
                            </th>
                            <td>
                                {{ $productCategory->name ?? '-' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group mt-3">
                    <a class="btn btn-secondary" href="{{ route('admin.sellers-product-categories.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
