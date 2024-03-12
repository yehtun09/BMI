<!-- resources/views/admin/sellerType/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold"> {{ trans('global.create') }} {{ trans('cruds.sellerType.title_singular') }}</h5>
        <div class="card-body mt-4">
            <form method="POST" action="{{ route('admin.seller-type.store') }}" id="sellerType">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.sellerType.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            <span class="name_error"></span>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Add your additional form fields here --}}

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
        // Your script for handling form validation or other JavaScript logic goes here
    </script>
@endsection
