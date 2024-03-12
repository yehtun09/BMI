@extends('layouts.admin')

@section('content')
    <div class="card">
        <h6 class="font-weight-bold card-header mb-5">
            {{ trans('global.show') }} {{ trans('cruds.sellerType.title') }}
        </h6>
        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerType.fields.id') }}
                            </th>
                            <td>
                                {{ $seller_type->id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sellerType.fields.name') }}
                            </th>
                            <td>
                                {{ $seller_type->name ?? '' }}
                            </td>
                        </tr>

                        {{-- Add any additional fields you want to display in the show page here --}}

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-secondary mt-3" href="{{ route('admin.seller-type.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection