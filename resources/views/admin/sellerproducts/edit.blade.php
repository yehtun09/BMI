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
            {{ trans('global.create') }} {{ trans('cruds.sellerProduct.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.seller-product.update',[$sellerProduct->id]) }}" enctype="multipart/form-data"
                id="myForm">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="seller_product_type_id">{{ trans('cruds.sellerProduct.fields.seller_product_type_id') }}</label>
                            <select class="select2 mb-3" aria-label="form-select-lg example" name="seller_product_type_id"
                                id="seller_product_type_id">
                                <option selected value="">--- Select ProductType ---</option>
                                @foreach ($sellerProductTypes as $key => $product)
                                    <option value="{{ $key }}" @if ($sellerProduct->seller_product_type_id == $key)
                                        selected
                                    @endif>{{ $product }}</option>
                                @endforeach
                            </select>
                            <span class="seller_product_type_id_error"></span>
                            @if ($errors->has('seller_product_type_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seller_product_type_id') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="measurement_id">{{ trans('cruds.sellerProduct.fields.measurement_id') }}</label>
                            <select class="select2 mb-3" aria-label="form-select-lg example" name="measurement_id"
                                id="measurement_id">
                                <option selected value="">--- Select Measurement ---</option>
                                @foreach ($measurements as $key => $measurement)
                                    <option value="{{ $key }}" @if ($sellerProduct->measurement_id == $key)
                                        selected
                                    @endif>{{ $measurement }}</option>
                                @endforeach
                            </select>
                            <span class="measurement_id_error"></span>
                            @if ($errors->has('measurement_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('measurement_id') }}
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="weight">{{ trans('cruds.sellerProduct.fields.weight') }}</label>
                            <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="text"
                                name="weight" id="weight" value="{{ old('weight', $sellerProduct->weight) }}">
                            <span class="weight_error"></span>
                            @if ($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="order_date">{{ trans('cruds.sellerProduct.fields.order_date') }}</label>
                            <input class="form-control datetime {{ $errors->has('order_date') ? 'is-invalid' : '' }}"
                            type="datetime-local" name="order_date" id="order_date"  value="{{ old('order_date', $sellerProduct->order_date ) }}">
                            <span class="order_date_error"></span>
                            @if ($errors->has('order_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_date') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="rice_percentage_one">{{ trans('cruds.sellerProduct.fields.rice_percentage_one') }}</label>
                            <input class="form-control {{ $errors->has('rice_percentage_one') ? 'is-invalid' : '' }}"
                                type="text" name="rice_percentage_one" id="rice_percentage_one"
                                value="{{ old('rice_percentage_one', $sellerProduct->rice_percentage_one) }}">
                            <span class="rice_percentage_one_error"></span>
                            @if ($errors->has('rice_percentage_one'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rice_percentage_one') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="rice_percentage_two">{{ trans('cruds.sellerProduct.fields.rice_percentage_two') }}</label>
                            <input class="form-control {{ $errors->has('rice_percentage_two') ? 'is-invalid' : '' }}"
                                type="text" name="rice_percentage_two" id="rice_percentage_two"
                                value="{{ old('rice_percentage_two', $sellerProduct->rice_percentage_two) }}">
                            <span class="rice_percentage_two_error"></span>
                            @if ($errors->has('rice_percentage_two'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rice_percentage_two') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="total_amount">{{ trans('cruds.sellerProduct.fields.total_amt') }}</label>
                            <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="text"
                                name="total_amount" id="total_amount" value="{{ old('total_amount', $sellerProduct->total_amount) }}">
                            <span class="total_amount_error"></span>
                            @if ($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="price">{{ trans('cruds.sellerProduct.fields.price') }}</label>
                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text"
                                name="price" id="price" value="{{ old('price', $sellerProduct->price) }}">
                            <span class="price_error"></span>
                            @if ($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="address">{{ trans('cruds.sellerProduct.fields.address') }}</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                                name="address" id="address" value="{{ old('address', $sellerProduct->address) }}">
                            <span class="address_error"></span>
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class=""
                                for="photo">{{ trans('cruds.sellerProduct.fields.photo') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" name="photo"
                                id="photoDropzone">
                            </div>
                            <span class="photo_error"></span>
                            @if ($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
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
         config = {
            enableTime:false,
            dateFormat: "Y-m-d",
        }
        flatpickr("input[type=datetime-local]", config);
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
                console.log({
                    file
                }, {
                    response
                })
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
                @if (isset($sellerProduct) && $sellerProduct->photo)
                    var file = {!! json_encode($sellerProduct->photo) !!}
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
