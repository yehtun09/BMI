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
            {{ trans('global.create') }} {{ trans('cruds.product_category_prices.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-category-prices.store') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product_category_prices.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ' ' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" >
                            <span class="name_error"></span>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="required" for="product_category_id">{{ trans('cruds.product_category_prices.fields.product_category') }}</label>
                                {{-- <input class="form-control {{ $errors->has('product_category_id') ? 'is-invalid' : ' ' }}" type="text"
                                    name="product_category_id" id="product_category_id" value="{{ old('product_category_id', '') }}" > --}}
                                    <select class="select2 mb-3" aria-label="form-select-lg example" name="product_category_id" id="product_category_id">
                                        <option selected value="">Open this select menu</option>
                                        @foreach ($productCategories as $key => $product_category)
                                            <option  value="{{ $key }}">{{ $product_category }}</option>
                                        @endforeach
                                    </select>
                                <span class="product_category_id_error"></span>
                                @if($errors->has('product_category_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product_category_id') }}
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
