@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold">{{ trans('global.create') }} {{ trans('cruds.sellerUserStatus.title_singular') }}</h5>
        <div class="card-body mt-4">
            <form method="POST" action="{{ route('admin.seller-user-statuses.store') }}" id="sellerUserStatus">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="seller_product_id">{{ trans('cruds.sellerUserStatus.fields.seller_product_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('seller_product_id') ? 'is-invalid' : '' }}" name="seller_product_id" id="seller_product_id">
                                <option value="" disabled selected>-- Select Product ---</option>
                                @foreach($sellerProducts as $id => $sellerProduct)
                                    <option value="{{ $sellerProduct->id }}" {{ old('seller_product_id') == $sellerProduct->id ? 'selected' : '' }}>{{ $sellerProduct->sellerProductType->name }}</option>
                                @endforeach
                            </select>
                            <span class="seller_product_id_error"></span>
                            @if($errors->has('seller_product_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seller_product_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.sellerUserStatus.fields.user_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                                <option value="" disabled selected>-- select User ---</option>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            <span class="user_id_error"></span>
                            @if($errors->has('user_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.sellerUserStatus.fields.status_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('status_id') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                                <option value="" disabled selected>-- select Status ---</option>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <span class="status_id_error"></span>
                            @if($errors->has('status_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.sellerUserStatus.fields.date') }}</label>
                            <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}"  type="datetime-local" name="date" id="date" value="{{ old('date') }}">
                            <span class="date_error"></span>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="d-flex">
                    <div class="form-group mt-2">
                        <button class="btn btn-success" type="submit" id="save">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                    <div class="form-group mt-2 ms-2">
                        <a onclick="history.back()" class="btn btn-secondary text-white">
                            {{ trans('global.cancel') }}
                        </a>
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
@endsection
