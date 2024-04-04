@extends('layouts.admin')
@section('styles')
    <style>
         .title_error {
            color: red;
            font-size: 13px;
            font-style: italic;
        }

        .required:after {
            content: " *";
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.today_price.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.today-price.store') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.date') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : ' ' }}" type="date"
                                name="date" id="date" value="{{ old('date', '') }}" >
                            <span class="date_error"></span>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.type') }}</label>
                            <input class="form-control {{ $errors->has('type') ? 'is-invalid' : ' ' }}" type="type"
                                name="type" id="type" value="{{ old('type', '') }}" >
                            <span class="type_error"></span>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.sell_price') }}</label>
                            <input class="form-control {{ $errors->has('sell_price') ? 'is-invalid' : ' ' }}" type="text"
                                name="sell_price" id="sell_price" value="{{ old('sell_price', '') }}" >
                            <span class="sell_price_error"></span>
                            @if($errors->has('sell_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sell_price') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.buy_price') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : ' ' }}" type="text"
                                name="buy_price" id="buy_price" value="{{ old('buy_price', '') }}" >
                            <span class="buy_price_error"></span>
                            @if($errors->has('buy_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('buy_price') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.rice') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : ' ' }}" type="text"
                                name="rice" id="rice" value="{{ old('rice', '') }}" >
                            <span class="rice_error"></span>
                            @if($errors->has('rice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rice') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.today_price.fields.remark') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : ' ' }}" type="textarea"
                                name="remark" id="remark" value="{{ old('remark', '') }}" >
                            <span class="remark_errpr"></span>
                            @if($errors->has('remark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remark') }}
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                        <div class="form-group mt-2">
                            <button class="btn btn-success" type="submit" id="save">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                        <div class="form-group mt-2 ms-2">
                            <a onclick=history.back() class="btn btn-secondary text-white">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
