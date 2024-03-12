<!-- resources/views/admin/sellerUserStatus/show.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.sellerUserStatus.title_singular') }}
        </h6>
        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerUserStatus.fields.id') }}
                            </th>
                            <td>
                                {{ $sellerUserStatus->id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerUserStatus.fields.seller_product_id') }}
                            </th>
                            <td>
                                {{ $sellerUserStatus->sellerProduct->sellerProductType->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerUserStatus.fields.user_id') }}
                            </th>
                            <td>
                                {{ $sellerUserStatus->user->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerUserStatus.fields.status_id') }}
                            </th>
                            <td>
                                {{ $sellerUserStatus->status->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerUserStatus.fields.date') }}
                            </th>
                            <td>
                                {{ $sellerUserStatus->date ?? '' }}
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary mt-3" href="{{ route('admin.seller-user-statuses.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
