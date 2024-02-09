@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productCategory.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.published') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $productCategory->published ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($productCategory->photo)
                                            <a href="{{ $productCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $productCategory->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCategory.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $productCategory->slug }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection