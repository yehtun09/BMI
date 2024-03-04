@extends('layouts.admin')
@section('content')

<div class="card">
   
    <h6 class="font-weight-bold card-header mb-5">
        {{ trans('global.show') }} {{ trans('cruds.product_category.title') }}
    </h6>

    <div class="card-body">
        <div class="form-group">
           
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product_category.fields.id') }}
                        </th>
                        <td>
                            {{ $product_category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product_category.fields.name') }}
                        </th>
                        <td>
                            {{ $product_category->name }}
                        </td>
                    </tr>
                    
                   
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary mt-3" href="{{ route('admin.product-category.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#service_person_service_assigns" role="tab" data-toggle="tab">
                {{ trans('cruds.serviceAssign.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="service_person_service_assigns">
            @includeIf('admin.users.relationships.servicePersonServiceAssigns', ['serviceAssigns' => $user->servicePersonServiceAssigns])
        </div>
    </div>
</div> --}}

@endsection
