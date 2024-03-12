@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.status.title_singular') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>{{ trans('cruds.status.fields.id') }}</th>
                            <td>{{ $status->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.status.fields.name') }}</th>
                            <td>{{ $status->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.status.fields.type') }}</th>
                            <td>{{ $status->type }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.status-all.index') }}" class="btn btn-default">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
@endsection
