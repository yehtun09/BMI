@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold mb-4"> {{ trans('global.edit') }} {{ trans('cruds.seller.title_singular') }}</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.seller.update',$seller->id) }}" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row d-flex flex-warp">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.seller.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', $seller->name) }}" >
                            <span class="name_error"></span>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="phone_no">{{ trans('cruds.seller.fields.phone_no') }}</label>
                            <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="text"
                                name="phone_no" id="phone_no" value="{{ old('phone_no', $seller->phone_no) }}" >
                            <span class="phone_no_error"></span>
                            @if ($errors->has('phone_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_no') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.seller.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="text"
                                name="password" id="password" value="{{ old('password', $seller->password) }}" >
                            <span class="password_error"></span>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="address">{{ trans('cruds.seller.fields.address') }}</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                                name="address" id="address" value="{{ old('address', $seller->address) }}" >
                            <span class="address_error"></span>
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="seller_type_id">{{ trans('cruds.seller.fields.seller_type_id') }}</label>
                            <select name="seller_type_id" id="" class="select2 ">
                                <option value="">-- Select Seller Category --</option>
                                @foreach ($seller_types as $key => $seller_type)
                                    <option value="{{ $seller_type->id }}"
                                        {{ $seller_type->id == $seller->seller_type_id ? 'selected' : '' }}> {{ $seller_type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="seller_type_id_error"></span>
                            @if ($errors->has('seller_type_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seller_type_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex ">
                        <div class="form-group mt-2 mr-3">
                            <button class="btn btn-success" type="submit" id="save">
                                {{ trans('global.update') }}
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
        $('#save').on('click', function(e) {
            e.preventDefault();
            formValidation();
        })

        var formValidation = () => {
            let title = $('#title').val();

            if (title == '') {
                $('.title_error').html(
                    '{{ trans('cruds.seller.fields.title') }} {{ trans('global.must_be_filled') }}');
            } else {
                $('#myForm').submit();
            }
        }
    </script>
@endsection --}}
