@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold mb-4"> {{ trans('global.edit') }} {{ trans('cruds.seller_product_type.title_singular') }}</h5>        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.seller-product-type.update', [$seller_product_type->id]) }}" enctype="multipart/form-data"
                id="myForm">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.seller_product_type.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', $seller_product_type->name) }}" >
                            <span class="name_error"></span>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                           
                        </div>
                    </div>
                    
                    <div class="form-group col-5">
                        <label class="required" for="seller_product_type">{{ trans('cruds.seller_product_type.fields.seller_product_category') }}</label>
                        <select name="product_category_id" id="type" class="select2 ">
                            <option value="">-- Select Type --</option>
                            @foreach ($seller_product_categories as $key => $product_category)
                                <option value="{{$product_category->id}}" {{ $product_category->id == $seller_product_type->product_category_id ? 'selected' : '' }}> {{ $product_category->name }}</option>
                            @endforeach
                        </select>
                        <span class="product_category_id"></span>
                        @if ($errors->has('product_category_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_category_id') }}
                            </div>
                        @endif
                    </div>
                    {{-- <div class="form-group col-5" id="ProductCategories">
                        <label class="required" for="seller_product_type">{{ trans('cruds.seller_product_type.fields.product_category') }}</label>
                        <select name="product_category_id" id="product_category_id" class="select2 ">
                            <option value="">-- Select Type --</option>
                            @foreach ($product_categories as $key => $product_category)
                                <option value="{{$product_category->id}}" {{ $seller_product_type->product_category_id == $product_category->id ? 'selected' : '' }}> {{ $product_category->name }}</option>
                            @endforeach
                        </select>
                        <span class="product_category_id_error"></span>
                        @if ($errors->has('product_category_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_category_id') }}
                            </div>
                        @endif
                    </div> --}}
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
{{-- @section('scripts')
    <script>
        if($('#type').val() == 1)
        {
            $('#ProductCategories').hide();
        }
        $('#type').on('change', function(e) {
            id = $(this).val();
            console.log(id)
            if (id == 1) {
                console.log(" equal to 1")

                $('#ProductCategories').hide();
                $('#product_category_id').val("");
            } else {
                console.log("Not equal to 1")
                $('#ProductCategories').show();
            }
        })

      
    </script>
@endsection --}}


