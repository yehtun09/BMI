@extends('layouts.admin')
@section('content')

<div class="card">
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.buyers.title') }}
    </h6>
    {{-- <div class="card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.buyers.title') }}
    </div> --}}

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.id') }}
                        </th>
                        <td>
                            {{ $buyer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.name') }}
                        </th>
                        <td>
                            {{ $buyer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.address') }}
                        </th>
                        <td>
                            {{ $buyer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $buyer->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.buyer_category') }}
                        </th>
                        <td>
                            {{ config('constant.buyerCategory.' . $buyer->buyer_category, '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.buyers.fields.password') }}
                        </th>
                        <td>
                            {{ $buyer->password }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.buyers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection