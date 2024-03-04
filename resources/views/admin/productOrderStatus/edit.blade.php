@extends('layouts.admin')

@section('styles')

@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.product_order_status.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-order-status.update', [$productOrderStatus->id]) }}"
                enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="product_order_id">{{ trans('cruds.product_order_status.fields.product_order_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('product_order_id') ? 'is-invalid' : '' }}"
                                name="product_order_id" id="product_order_id" required>
                                <option value="" disabled selected>Select Product Order</option>
                                @foreach($productOrders as $productOrder)
                                    <option value="{{ $productOrder->id }}" {{ ($productOrderStatus->product_order_id == $productOrder->id) ? 'selected' : '' }}>{{ $productOrder->product->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_order_id'))
                                <span class="text-danger">{{ $errors->first('product_order_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="user_id">{{ trans('cruds.product_order_status.fields.user_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                name="user_id" id="user_id" required>
                                <option value="" disabled selected>Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ ($productOrderStatus->user_id == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user_id'))
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="status_id">{{ trans('cruds.product_order_status.fields.status_id') }}</label>
                            <select class="form-control select2 {{ $errors->has('status_id') ? 'is-invalid' : '' }}"
                                name="status_id" id="status_id" required>
                                <option value="" disabled selected>Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ ($productOrderStatus->status_id == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status_id'))
                                <span class="text-danger">{{ $errors->first('status_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="date">{{ trans('cruds.product_order_status.fields.date') }}</label>
                            <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                type="text" name="date" id="date" value="{{ old('date', $productOrderStatus->date) }}" required>
                            @if($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('admin.product-order-status.index') }}"
                        class="btn btn-secondary text-white">{{ trans('global.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        flatpickr('#date', {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
        });

        // Add your scripts or adjust existing ones if needed
    </script>
@endsection
