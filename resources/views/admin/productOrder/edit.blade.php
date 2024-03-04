@extends('layouts.admin')
@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product_order.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-order.update', [$product_order->id]) }}"
                enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="product_id">{{ trans('cruds.product_order.fields.product_id') }}</label>
                            <select class="select2 mb-3" aria-label="form-select-lg example" name="product_id"
                                id="product_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($products as $key => $product)
                                    <option value="{{ $product->id }}" @if ($product->id == $product_order->product_id) selected @endif>
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
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required"
                                for="buyer_id">{{ trans('cruds.product_order.fields.buyer_id') }}</label>
                            <select class="select2 mb-3" aria-label=".form-select-lg example" name="buyer_id"
                                id="buyer_id">
                                <option selected value="">Open this select menu</option>
                                @foreach ($buyers as $key => $buyer)
                                    <option value="{{ $buyer->id }}" @if ($buyer->id == $product_order->buyer_id) selected @endif>
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
                            <label class="required" for="order_date">{{ trans('cruds.product_order.fields.order_date') }}</label>
                            <input class="form-control {{ $errors->has('order_date') ? 'is-invalid' : ' ' }}"
                                type="datetime-local" name="order_date" id="date" value="{{ old('order_date', $product_order->order_date) }}">
                            {{-- <input class="form-control {{ $errors->has('name') ? 'is-invalid' : ' ' }}" type="text"
                                name="name" id="name" value="{{ old('name', $product_order->name) }}" > --}}
                            <span class="order_date"></span>
                            @if ($errors->has('order_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_date') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="qty">{{ trans('cruds.product_order.fields.qty') }}</label>
                            <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : ' ' }}" type="number"
                                name="qty" id="qty" value="{{ old('qty', $product_order->qty) }}">
                            <span class="qty_error"></span>
                            @if ($errors->has('qty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="total_amount">{{ trans('cruds.product_order.fields.total_amount') }}</label>
                            <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : ' ' }}" type="number"
                                name="total_amount" id="total_amount" value="{{ old('total_amount', $product_order->total_amount) }}">
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
                            <label class="required" for="delivery_address">{{ trans('cruds.product_order.fields.delivery_address') }}</label>
                            <input class="form-control {{ $errors->has('delivery_address') ? 'is-invalid' : ' ' }}" type="text"
                                name="delivery_address" id="delivery_address" value="{{ old('delivery_address', $product_order->delivery_address) }}">
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
                            <label class="required" for="phone_no">{{ trans('cruds.product_order.fields.phone_no') }}</label>
                            <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : ' ' }}" type="text"
                                name="phone_no" id="phone_no" value="{{ old('phone_no', $product_order->phone_no) }}">
                            <span class="phone_no_error"></span>
                            @if ($errors->has('phone_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_no') }}
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
                    url: '{{ url('admin/product/getmeasurement') }}/' + id,
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

            if (id == 0) {
                selectElement.html(`<option value="" selected>--- Select Measurement ---</option>`)
            }
        })
    </script>
@endsection
