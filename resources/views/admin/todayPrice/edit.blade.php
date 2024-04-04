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
            <form method="POST" action="{{ route('admin.today-price.update',[$today_price->id]) }}" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.today_price.fields.date') }}</label>
                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : ' ' }}" type="date"
                                name="date" id="date" value="{{ old('date', $today_price->date) }}" >
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
                            <label class="required" for="type">{{ trans('cruds.today_price.fields.type') }}</label>
                            <input class="form-control {{ $errors->has('type') ? 'is-invalid' : ' ' }}" type="text"
                                name="type" id="type" value="{{ old('type', $today_price->type) }}" >
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
                            <label class="required" for="buy_price">{{ trans('cruds.today_price.fields.buy_price') }}</label>
                            <input class="form-control {{ $errors->has('type') ? 'is-invalid' : ' ' }}" type="text"
                                name="buy_price" id="buy_price" value="{{ old('buy_price', $today_price->buy_price) }}" >
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
                            <label class="required" for="sell_price">{{ trans('cruds.today_price.fields.sell_price') }}</label>
                            <input class="form-control {{ $errors->has('sell_price') ? 'is-invalid' : ' ' }}" type="text"
                                name="sell_price" id="sell_price" value="{{ old('sell_price', $today_price->sell_price) }}" >
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
                            <label class="required" for="rice">{{ trans('cruds.today_price.fields.rice') }}</label>
                            <input class="form-control {{ $errors->has('rice') ? 'is-invalid' : ' ' }}" type="text"
                                name="rice" id="rice" value="{{ old('rice', $today_price->rice) }}" >
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
                            <label class="required" for="remark">{{ trans('cruds.today_price.fields.remark') }}</label>
                            <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : ' ' }}" type="text"
                                name="remark" id="remark" value="{{ old('remark', $today_price->remark) }}" >
                            <span class="remark_error"></span>
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
