@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.pageSection.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.page-sections.update", [$pageSection->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ $pageSection->published || old('published', 0) === 1 ? 'checked' : '' }}>
                                <label for="published">{{ trans('cruds.pageSection.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('published') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="custom_class">{{ trans('cruds.pageSection.fields.custom_class') }}</label>
                            <input class="form-control" type="text" name="custom_class" id="custom_class" value="{{ old('custom_class', $pageSection->custom_class) }}">
                            @if($errors->has('custom_class'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('custom_class') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.custom_class_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.pageSection.fields.default_section_classes') }}</label>
                            <select class="form-control" name="default_section_classes" id="default_section_classes">
                                <option value disabled {{ old('default_section_classes', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\PageSection::DEFAULT_SECTION_CLASSES_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('default_section_classes', $pageSection->default_section_classes) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('default_section_classes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_section_classes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.default_section_classes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_title">{{ trans('cruds.pageSection.fields.section_title') }}</label>
                            <input class="form-control" type="text" name="section_title" id="section_title" value="{{ old('section_title', $pageSection->section_title) }}">
                            @if($errors->has('section_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.section_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="section">{{ trans('cruds.pageSection.fields.section') }}</label>
                            <textarea class="form-control" name="section" id="section" required>{{ old('section', $pageSection->section) }}</textarea>
                            @if($errors->has('section'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.section_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="section_nickname">{{ trans('cruds.pageSection.fields.section_nickname') }}</label>
                            <input class="form-control" type="text" name="section_nickname" id="section_nickname" value="{{ old('section_nickname', $pageSection->section_nickname) }}">
                            @if($errors->has('section_nickname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section_nickname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.section_nickname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="order">{{ trans('cruds.pageSection.fields.order') }}</label>
                            <input class="form-control" type="number" name="order" id="order" value="{{ old('order', $pageSection->order) }}" step="1">
                            @if($errors->has('order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="css">{{ trans('cruds.pageSection.fields.css') }}</label>
                            <textarea class="form-control" name="css" id="css">{{ old('css', $pageSection->css) }}</textarea>
                            @if($errors->has('css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.css_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="js">{{ trans('cruds.pageSection.fields.js') }}</label>
                            <textarea class="form-control" name="js" id="js">{{ old('js', $pageSection->js) }}</textarea>
                            @if($errors->has('js'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('js') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.js_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cdn_css">{{ trans('cruds.pageSection.fields.cdn_css') }}</label>
                            <textarea class="form-control" name="cdn_css" id="cdn_css">{{ old('cdn_css', $pageSection->cdn_css) }}</textarea>
                            @if($errors->has('cdn_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cdn_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.cdn_css_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cdn_js">{{ trans('cruds.pageSection.fields.cdn_js') }}</label>
                            <textarea class="form-control" name="cdn_js" id="cdn_js">{{ old('cdn_js', $pageSection->cdn_js) }}</textarea>
                            @if($errors->has('cdn_js'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cdn_js') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.cdn_js_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="use_editor" value="0">
                                <input type="checkbox" name="use_editor" id="use_editor" value="1" {{ $pageSection->use_editor || old('use_editor', 0) === 1 ? 'checked' : '' }}>
                                <label for="use_editor">{{ trans('cruds.pageSection.fields.use_editor') }}</label>
                            </div>
                            @if($errors->has('use_editor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('use_editor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pageSection.fields.use_editor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection