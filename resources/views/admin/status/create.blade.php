@extends('layouts.admin')

@section('content')
    <div class="card">
        <h5 class="card-header font-weight-bold"> {{ trans('global.create') }}
            {{ trans('cruds.measurement.title_singular') }}</h5>
        <div class="card-body mt-4">
            <form method="POST" action="{{ route('admin.status-all.store') }}">
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
                        <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text"
                            name="type" id="type" value="{{ old('type', ' ') }}">
                        @if ($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
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
      
    </script>
@endsection
