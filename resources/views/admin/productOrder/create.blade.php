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
            {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
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
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : ' ' }}" type="text"
                                name="price" id="price" value="{{ old('price', '') }}" >
                            <span class="price_error"></span>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                        
                        </div>
                    </div>
                  
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="weight">{{ trans('cruds.product.fields.weight') }}</label>
                            <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : ' ' }}" type="text"
                                name="weight" id="weight" value="{{ old('weight', '') }}" >
                            <span class="weight_error"></span>
                            @if($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                        
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="product_category_id">{{ trans('cruds.product.fields.product_category') }}</label>
                            {{-- <input class="form-control {{ $errors->has('product_category_id') ? 'is-invalid' : ' ' }}" type="text"
                                name="product_category_id" id="product_category_id" value="{{ old('product_category_id', '') }}" > --}}
                                <select class="select2 mb-3" aria-label="form-select-lg example" name="product_category_id" id="product_category_id"> 
                                    <option selected value="">Open this select menu</option>
                                    @foreach ($productCategories as $key => $ProductCategory)
                                        <option  value="{{ $key }}">{{ $ProductCategory }}</option>
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

                    {{-- Measurement --}}
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="measurement_id">{{ trans('cruds.product.fields.measurement') }}</label>
                            {{-- <input class="form-control {{ $errors->has('measurement_id') ? 'is-invalid' : ' ' }}" type="text"
                                name="measurement_id" id="measurement_id" value="{{ old('measurement_id', '') }}" > --}}
                                <select class="select2 mb-3" disabled aria-label="form-select-lg example" name="measurement_id" id="measurement_id"> 
                                    <option selected value="">Open this select menu</option>
                                    {{-- @foreach ($measurements as $key => $measurement)
                                        <option  value="{{ $key }}">{{ $measurement }}</option>
                                    @endforeach --}}
                                </select>
                            <span class="measurement_id_error"></span>
                            @if($errors->has('measurement_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('measurement_id') }}
                                </div>
                            @endif
                        
                        </div>
                    </div>
                  
                    
                  
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label>
                            <input class="form-control {{ $errors->has('image') ? 'is-invalid' : ' ' }}" type="file"
                                name="photo" id="photo" value="{{ old('image', '') }}" >
                            <span class="image_error"></span>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
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
@section('scripts')
    <script>
        

         $('#product_category_id').on('change', function(e) { 
        id = $(this).val();
        var selectElement = $('#measurement_id');
        if ($(this).val() === '') {
            selectElement.prop('disabled', true);
        } else {
            selectElement.prop('disabled', false);
            $.ajax({
                type: 'GET',
                url: '{{ url("admin/product/getmeasurement") }}/' + id,
                data: {
                    id: id
                },
                success: function(data) {
                   
                    let html = '';
                    if (data.product_categories.length != 0) {
                        html += ` <option value="" selected>--- Select Measurement ---</option>`
                        data.product_categories.forEach((element, index) => {
                            html += `
                            <option value='${element.id}'>${element.name}</option>
                                    `;
                        });
                    } else {
                        html += ` <option value="" selected>--- Select Measurement ---</option>`
                    }
                    $('#measurement_id').html(html);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }

        if(id==0){  
            selectElement .html(`<option value="" selected>--- Select Measurement ---</option>`)
        }
    })




    </script>
@endsection
