@extends('layouts.admin')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.product_order_details.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-order-details.update', [$productOrderDetail->id]) }}"
                enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="product_order_id">{{ trans('cruds.product_order_details.fields.product_order_id') }}</label>
                            <select class="select2 mb-3" aria-label=".form-select-lg example" name="product_order_id" id="product_order_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($productOrders as $key => $product)
                                    <option value="{{ $product->id }}" @if ($product->id == $productOrderDetail->product_order_id) selected @endif>
                                        {{ $product->buyer->name }}</option>
                                @endforeach
                            </select>
                            <span class="product_order_id"></span>
                            @if ($errors->has('product_order_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_order_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="measurement_id">{{ trans('cruds.product_order_details.fields.measurement_id') }}</label>
                            <select class="select2 mb-3" aria-label=".form-select-lg example" name="measurement_id" id="measurement_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($measurements as $key => $measurement)
                                    <option value="{{ $measurement->id }}" @if ($measurement->id == $productOrderDetail->measurement_id) selected @endif>
                                        {{ $measurement->name }}</option>
                                @endforeach
                            </select>
                            <span class="measurement_id"></span>
                            @if ($errors->has('measurement_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('measurement_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="product_id">{{ trans('cruds.product_order_details.fields.product_id') }}</label>
                            <select class="select2 mb-3" aria-label=".form-select-lg example" name="product_id" id="product_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($products as $key => $product)
                                    <option value="{{ $product->id }}" @if ($product->id == $productOrderDetail->product_id) selected @endif>
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                            <span class="product_id"></span>
                            @if ($errors->has('product_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="order_date">{{ trans('cruds.product_order_details.fields.order_date') }}</label>
                            <input class="form-control {{ $errors->has('order_date') ? 'is-invalid' : '' }}" type="order_datetime-local" name="order_date" id="order_date" value="{{ old('order_date', $productOrderDetail->order_date) }}">
                            <span class="order_date_error"></span>
                            @if ($errors->has('order_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_date') }}
                                </div>
                            @endif
                        </div>
                    </div> --}}

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="total_amount">{{ trans('cruds.product_order_details.fields.total_amount') }}</label>
                            <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $productOrderDetail->total_amount) }}">
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
                            <label class="required" for="qty">{{ trans('cruds.product_order_details.fields.qty') }}</label>
                            <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', $productOrderDetail->qty) }}">
                            <span class="qty_error"></span>
                            @if ($errors->has('qty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty') }}
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
