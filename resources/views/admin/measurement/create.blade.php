@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold"> {{ trans('global.create') }}
            {{ trans('cruds.measurement.title_singular') }}</h5>
        <div class="card-body mt-4">
            <form method="POST" action="{{ route('admin.measurement.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-5">
                        <label for="name">{{ trans('cruds.measurement.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', ' ') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-5">
                        <label class="required" for="measurement">{{ trans('cruds.measurement.fields.type') }}</label>
                        <select name="type" id="type" class="select2 ">
                            <option value="">-- Select Type --</option>
                            @foreach (config('constant.measurement_type') as $key => $item)
                                <option value="{{ $key }}"
                                    @if (old('type')) {{ old('type') == $key ? 'selected' : '' }} @endif>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-5" id="ProductCategories">
                        <label class="required"
                            for="measurement">{{ trans('cruds.measurement.fields.product_category') }}</label>
                        <select name="product_category_id" id="product_category_id" class="select2 ">
                            <option value="">-- Select Type --</option>
                            @foreach ($product_categories as $key => $product_category)
                                <option value="{{ $product_category->id }}"
                                    @if (old('product_category_id')) {{ old('product_category_id') == $product_category->id ? 'selected' : '' }} @endif>
                                    {{ $product_category->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_category_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_category_id') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class=" d-flex">
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
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#type').on('change', function(e) {
            id = $(this).val();
            if (id == 1) {
                $('#ProductCategories').hide();
                $('#product_category_id').val("null");
            } else {
                $('#ProductCategories').show();
            }
        })

      
    </script>
@endsection
