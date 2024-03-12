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
                            {{ trans('cruds.seller.fields.id') }}
                        </th>
                        <td>
                            {{ $seller->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.name') }}
                        </th>
                        <td>
                            {{ $seller->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.address') }}
                        </th>
                        <td>
                            {{ $seller->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $seller->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.password') }}
                        </th>
                        <td>
                            {{ $seller->password }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.seller_type_id') }}
                        </th>
                        <td>
                            {{  $seller->seller_type_id ?? ' ' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.seller.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection