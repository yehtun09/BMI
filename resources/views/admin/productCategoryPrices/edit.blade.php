@extends('layouts.admin')
@section('styles')
    <style>
        .name_error,
        .product_category_id_error {
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
        <h5 class="card-header font-weight-bold mb-4"> {{ trans('global.edit') }} {{ trans('cruds.product_category_prices.title_singular') }}</h5>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-category-prices.update', [$product_category_prices->id]) }}" enctype="multipart/form-data"
                id="myForm">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product_category_prices.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ' ' }}" type="text"
                                name="name" id="name" value="{{ old('name', $product_category_prices->name) }}" >
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
                            <label class="required" for="product_category_id">{{ trans('cruds.product.fields.product_category') }}</label>
                                <select class="select2 mb-3" aria-label=".form-select-lg example" name="product_category_id" id="product_category_id">
                                    <option selected value="">Open this select menu</option>
                                    @foreach ($sellerProductCategory as $key => $sellerProductCategory)
                                        <option  value="{{ $key }}" @if ($key == $product_category_prices->product_category_id)
                                            selected
                                        @endif>{{ $sellerProductCategory }}</option>
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
                        <div class="form-group mr-3 mt-2">
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
@section('scripts')
    <script>
        $('#save').on('click', function(e) {
            e.preventDefault();
            formValidation();
        })

        var formValidation = () => {
            let name = $('#name').val();
            let product_category_id = $('#product_category_id').val();
            let arr = [];
            if (name == '') {
                $('.name_error').html('Name must be filled');
                arr.push('name');
            } else {
                $('.name_error').html('');
                if (arr.includes("name")) {
                    arr.splice(arr.indexOf('name'), 1);
                }
            }

            if (product_category_id == '') {
                $('.product_category_id_error').html('Product Category Id must be filled');
                arr.push('product_category_id');
            } else {
                $('.product_category_id_error').html('');
                if (arr.includes("product_category_id")) {
                    arr.splice(arr.indexOf('product_category_id'), 1);
                }
            }

            if (arr.length == 0) {
                document.getElementById("myForm").submit();
            }
        }
    </script>
@endsection
