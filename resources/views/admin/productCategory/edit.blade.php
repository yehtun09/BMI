@extends('layouts.admin')
@section('styles')
    <style>
        .name_error,
        .email_error,
        .password_error,
        .role_error {
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
        <h5 class="card-header font-weight-bold mb-4"> {{ trans('global.edit') }} {{ trans('cruds.product_category.title_singular') }}</h5>
       
        <div class="card-body">
            <form method="POST" action="{{ route('admin.product-category.update', [$product_category->id]) }}" enctype="multipart/form-data"
                id="myForm">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product_category.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', $product_category->name) }}" >
                            <span class="name_error"></span>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                           
                        </div>
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                        <div class="form-group mr-3 mt-2">
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
{{-- @section('scripts')
    <script>
        $('#save').on('click', function(e) {
            e.preventDefault();
            formValidation();
        })

        var formValidation = () => {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let role = $('#roles').find(':selected').val();
            let arr = [];
            if (name == '') {
                $('.name_error').html('Name must be filled');
                arr.push('name');
            } else {
                $('.name_error').html('');
                if (arr.includes("name")) {
                    arr.splice(arr.indexOf('name'), 1);
                }
            }

            if (email == '') {
                $('.email_error').html('Email must be filled');
                arr.push('email');
            } else {
                $('.email_error').html('');
                if (arr.includes("email")) {
                    arr.splice(arr.indexOf('email'), 1);
                }
            }

            if (password == '') {
                $('.password_error').html('Password must be filled');
                arr.push('password');
            } else {
                $('.password_error').html('');
                if (arr.includes("password")) {
                    arr.splice(arr.indexOf('password'), 1);
                }
            }

            if (arr.length == 0) {
                document.getElementById("myForm").submit();
            }
        }
    </script>
@endsection --}}