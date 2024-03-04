
@extends('layouts.admin')
@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.measurement.title') }}
        </h6>
        <div class="card-body">
            <div class="form-group">
                
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.measurement.fields.id') }}
                            </th>
                            <td>
                                {{ $measurement->id ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.measurement.fields.name') }}
                            </th>
                            <td>
                                {{ $measurement->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.measurement.fields.type') }}
                            </th>
                            <td>
                                @if ($measurement->type == 1)
                                    Seller
                                @elseif ($measurement->type == 2)
                                    Buyer
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.measurement.fields.product_category') }}
                            </th>
                            <td>
                                {{ $measurement->productCategory->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group ">
                    <a class="btn btn-secondary mt-3" href="{{ route('admin.measurement.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
