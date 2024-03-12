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
            {{ trans('global.create') }} {{ trans('cruds.productMeasurement.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-measurements.update',[$productMeasurement->id]) }}" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="product_id">{{ trans('cruds.productMeasurement.fields.product_id') }}</label>
                                <select class="select2 mb-3" aria-label="form-select-lg example" name="product_id" id="product_id"> 
                                    <option selected value="">Open this select menu</option>
                                    @foreach ($products as $key => $product)
                                        <option  value="{{ $key }}" {{ $key === old('product_id') ? 'selected' : '' }} {{ $key === $productMeasurement->product_id ? 'selected' : '' }}>{{ $product }}</option>
                                    @endforeach
                                </select>
                            <span class="product_id_error"></span>
                            @if($errors->has('product_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_id') }}
                                </div>
                            @endif
                        
                        </div>
                    </div>
                  
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="product_category_id">{{ trans('cruds.product.fields.product_category') }}</label>
                                <select class="select2 mb-3" aria-label=".form-select-lg example" name="product_category_id" id="product_category_id"> 
                                    <option selected value="">Open this select menu</option>
                                    @foreach ($productCategories as $key => $ProductCategory)
                                        <option  value="{{ $key }}" @if ($key == $productMeasurement->product_category_id)
                                            selected
                                        @endif>{{ $ProductCategory }}</option>
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

                                    
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="measurement_id">{{ trans('cruds.product.fields.measurement') }}</label>
                                <select class="select2 mb-3" aria-label=".form-select-lg example" name="measurement_id"  id="measurement_id"> 
                                    <option selected value="">Open this select menu</option>
                                    @foreach ($measurements as $key => $measurement)
                                        <option  value="{{ $key }}" @if ($key == $productMeasurement->measurement_id)
                                            selected
                                        @endif>{{ $measurement }}</option>
                                    @endforeach
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
                            <label class="required" for="price">{{ trans('cruds.productMeasurement.fields.price') }}</label>
                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : ' ' }}" type="text"
                                name="price" id="price" value="{{ old('price', $productMeasurement->price) }}" >
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
                            <label class="required" for="weight">{{ trans('cruds.productMeasurement.fields.weight') }}</label>
                            <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : ' ' }}" type="text"
                                name="weight" id="weight" value="{{ old('weight', $productMeasurement->weight) }}" >
                            <span class="weight_error"></span>
                            @if($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                        
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label>
                            {{-- <input class="form-control {{ $errors->has('image') ? 'is-invalid' : ' ' }}" type="file"
                                name="photo" id="photo" value="{{ old('image', '') }}" > --}}
                                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photoDropzone">
                                </div>
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
        // console.log(selectElement.val()+"it measurement id");
        if ($(this).val() === '') {
            selectElement.prop('disabled', true);
        } else {
            console.log("it change");
            console.log(id);
            selectElement.prop('disabled', false);
            $.ajax({
                type: 'GET',
                url: '{{ url("admin/product-measurements/getmeasurement") }}/' + id,
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

<script>
    Dropzone.options.photoDropzone = {
        url: '{{ route('admin.posts.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function(file, response) {
            console.log({file},{response})
            $('form').find('input[name="photo"]').remove()
            $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
        },
        removedfile: function(file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="photo"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function() {
            @if (isset($productMeasurement) && $productMeasurement->photo)
                var file = {!! json_encode($productMeasurement->photo) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function(file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection
