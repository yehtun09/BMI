@extends('layouts.admin')
@section('styles')
   
@endsection
@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold mb-4"> {{ trans('global.edit') }} {{ trans('cruds.buyers.title_singular') }}</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.buyers.update',$buyer->id) }}" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row d-flex flex-warp">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.buyers.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', $buyer->name) }}" >
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
                            <label class="required" for="address">{{ trans('cruds.buyers.fields.address') }}</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                                name="address" id="address" value="{{ old('address', $buyer->address) }}" >
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
                            <label class="required" for="phone_no">{{ trans('cruds.buyers.fields.phone_no') }}</label>
                            <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="text"
                                name="phone_no" id="phone_no" value="{{ old('phone_no', $buyer->phone_no) }}" >
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
                            <label class="required" for="buyer_category">{{ trans('cruds.buyers.fields.buyer_category') }}</label>
                            <select name="buyer_category" id="" class="select2 ">
                                <option value="">-- Select Buyer Category --</option>
                                @foreach (config('constant.buyerCategory') as $key => $item)
                                    <option value="{{$key}}" {{ $key == old('buyer_category', $buyer->buyer_category) ? 'selected' : '' }}> {{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="buyer_category_error"></span>
                            @if ($errors->has('buyer_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('buyer_category') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="shop_name">{{ trans('cruds.buyers.fields.shop_name') }}</label>
                            <input class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" type="text"
                                name="shop_name" id="shop_name" value="{{ old('shop_name', $buyer->shop_name) }}" >
                            <span class="shop_name_error"></span>
                            @if ($errors->has('shop_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shop_name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="shop_address">{{ trans('cruds.buyers.fields.shop_address') }}</label>
                            <input class="form-control {{ $errors->has('shop_address') ? 'is-invalid' : '' }}" type="text"
                                name="shop_address" id="shop_address" value="{{ old('shop_address', $buyer->shop_address) }}" >
                            <span class="shop_address_error"></span>
                            @if ($errors->has('shop_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shop_address') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.buyers.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="text"
                                name="password" id="password" value="{{ old('password', $buyer->password) }}" >
                            <span class="password_error"></span>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
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
                    '{{ trans('cruds.buyer.fields.title') }} {{ trans('global.must_be_filled') }}');
            } else {
                $('#myForm').submit();
            }
        }
    </script>
@endsection --}}
