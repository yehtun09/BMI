@extends('layouts.admin')
@section('content')

<div class="card">
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.today_price.title') }}
    </h6>
    {{-- <div class="card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.today_price.title') }}
    </div> --}}

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.id') }}
                        </th>
                        <td>
                            {{ $today_price->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.date') }}
                        </th>
                        <td>
                            {{ $today_price->date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.type') }}
                        </th>
                        <td>
                            {{ $today_price->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.sell_price') }}
                        </th>
                        <td>
                            {{ $today_price->sell_price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.buy_price') }}
                        </th>
                        <td>
                            {{ $today_price->buy_price ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.rice') }}
                        </th>
                        <td>
                            {{ $today_price->rice ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.today_price.fields.remark') }}
                        </th>
                        <td>
                            {{ $today_price->remark ?? '' }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group mt-3">
                <a class="btn btn-secondary" href="{{ route('admin.today-price.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
