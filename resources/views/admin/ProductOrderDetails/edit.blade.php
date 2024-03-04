@extends('layouts.admin')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.product_order_details.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product_order_details.update', [$productOrderDetail->id]) }}"
                enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="buyer_id">{{ trans('cruds.product_order_details.fields.buyer_id') }}</label>
                            <select class="select2 mb-3" aria-label=".form-select-lg example" name="buyer_id" id="buyer_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($buyers as $key => $buyer)
                                    <option value="{{ $buyer->id }}" @if ($buyer->id == $productOrderDetail->buyer_id) selected @endif>
                                        {{ $buyer->name }}</option>
                                @endforeach
                            </select>
                            <span class="buyer_id"></span>
                            @if ($errors->has('buyer_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('buyer_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.product_order_details.fields.date') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="datetime-local" name="date" id="date" value="{{ old('date', $productOrderDetail->date) }}">
                            <span class="date_error"></span>
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="delivery_address">{{ trans('cruds.product_order_details.fields.delivery_address') }}</label>
                            <input class="form-control {{ $errors->has('delivery_address') ? 'is-invalid' : '' }}" type="text" name="delivery_address" id="delivery_address" value="{{ old('delivery_address', $productOrderDetail->delivery_address) }}">
                            <span class="delivery_address_error"></span>
                            @if ($errors->has('delivery_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('delivery_address') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="phone">{{ trans('cruds.product_order_details.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $productOrderDetail->phone) }}">
                            <span class="phone_error"></span>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
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
            enableTime: false,
            dateFormat: "Y-m-d",
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
@endsection
