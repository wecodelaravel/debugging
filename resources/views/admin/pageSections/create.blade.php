@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pageSection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.page-sections.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.pageSection.fields.published') }}</label>
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
                <input class="form-control {{ $errors->has('custom_class') ? 'is-invalid' : '' }}" type="text" name="custom_class" id="custom_class" value="{{ old('custom_class', '') }}">
                @if($errors->has('custom_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('custom_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.custom_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.pageSection.fields.default_section_classes') }}</label>
                <select class="form-control {{ $errors->has('default_section_classes') ? 'is-invalid' : '' }}" name="default_section_classes" id="default_section_classes">
                    <option value disabled {{ old('default_section_classes', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PageSection::DEFAULT_SECTION_CLASSES_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('default_section_classes', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <input class="form-control {{ $errors->has('section_title') ? 'is-invalid' : '' }}" type="text" name="section_title" id="section_title" value="{{ old('section_title', '') }}">
                @if($errors->has('section_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.section_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="section">{{ trans('cruds.pageSection.fields.section') }}</label>
                <textarea class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section" required>{{ old('section') }}</textarea>
                @if($errors->has('section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.section_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_nickname">{{ trans('cruds.pageSection.fields.section_nickname') }}</label>
                <input class="form-control {{ $errors->has('section_nickname') ? 'is-invalid' : '' }}" type="text" name="section_nickname" id="section_nickname" value="{{ old('section_nickname', '') }}">
                @if($errors->has('section_nickname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section_nickname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.section_nickname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order">{{ trans('cruds.pageSection.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order', '0') }}" step="1">
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="css">{{ trans('cruds.pageSection.fields.css') }}</label>
                <textarea class="form-control {{ $errors->has('css') ? 'is-invalid' : '' }}" name="css" id="css">{{ old('css') }}</textarea>
                @if($errors->has('css'))
                    <div class="invalid-feedback">
                        {{ $errors->first('css') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.css_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="js">{{ trans('cruds.pageSection.fields.js') }}</label>
                <textarea class="form-control {{ $errors->has('js') ? 'is-invalid' : '' }}" name="js" id="js">{{ old('js') }}</textarea>
                @if($errors->has('js'))
                    <div class="invalid-feedback">
                        {{ $errors->first('js') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.js_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cdn_css">{{ trans('cruds.pageSection.fields.cdn_css') }}</label>
                <textarea class="form-control {{ $errors->has('cdn_css') ? 'is-invalid' : '' }}" name="cdn_css" id="cdn_css">{{ old('cdn_css') }}</textarea>
                @if($errors->has('cdn_css'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cdn_css') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.cdn_css_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cdn_js">{{ trans('cruds.pageSection.fields.cdn_js') }}</label>
                <textarea class="form-control {{ $errors->has('cdn_js') ? 'is-invalid' : '' }}" name="cdn_js" id="cdn_js">{{ old('cdn_js') }}</textarea>
                @if($errors->has('cdn_js'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cdn_js') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pageSection.fields.cdn_js_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('use_editor') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="use_editor" value="0">
                    <input class="form-check-input" type="checkbox" name="use_editor" id="use_editor" value="1" {{ old('use_editor', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="use_editor">{{ trans('cruds.pageSection.fields.use_editor') }}</label>
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



@endsection