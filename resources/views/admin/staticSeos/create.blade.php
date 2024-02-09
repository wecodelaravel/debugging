@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.staticSeo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.static-seos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="page_name">{{ trans('cruds.staticSeo.fields.page_name') }}</label>
                <input class="form-control {{ $errors->has('page_name') ? 'is-invalid' : '' }}" type="text" name="page_name" id="page_name" value="{{ old('page_name', '') }}">
                @if($errors->has('page_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('page_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.page_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_path">{{ trans('cruds.staticSeo.fields.page_path') }}</label>
                <input class="form-control {{ $errors->has('page_path') ? 'is-invalid' : '' }}" type="text" name="page_path" id="page_path" value="{{ old('page_path', '') }}">
                @if($errors->has('page_path'))
                    <div class="invalid-feedback">
                        {{ $errors->first('page_path') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.page_path_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_title">{{ trans('cruds.staticSeo.fields.meta_title') }}</label>
                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', '') }}">
                @if($errors->has('meta_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.meta_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook_title">{{ trans('cruds.staticSeo.fields.facebook_title') }}</label>
                <input class="form-control {{ $errors->has('facebook_title') ? 'is-invalid' : '' }}" type="text" name="facebook_title" id="facebook_title" value="{{ old('facebook_title', '') }}">
                @if($errors->has('facebook_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.facebook_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter_title">{{ trans('cruds.staticSeo.fields.twitter_title') }}</label>
                <input class="form-control {{ $errors->has('twitter_title') ? 'is-invalid' : '' }}" type="text" name="twitter_title" id="twitter_title" value="{{ old('twitter_title', '') }}">
                @if($errors->has('twitter_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.twitter_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.staticSeo.fields.content_type') }}</label>
                <select class="form-control {{ $errors->has('content_type') ? 'is-invalid' : '' }}" name="content_type" id="content_type">
                    <option value disabled {{ old('content_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StaticSeo::CONTENT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('content_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('content_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.content_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="json_ld_tag">{{ trans('cruds.staticSeo.fields.json_ld_tag') }}</label>
                <textarea class="form-control {{ $errors->has('json_ld_tag') ? 'is-invalid' : '' }}" name="json_ld_tag" id="json_ld_tag">{{ old('json_ld_tag') }}</textarea>
                @if($errors->has('json_ld_tag'))
                    <div class="invalid-feedback">
                        {{ $errors->first('json_ld_tag') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.json_ld_tag_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('canonical') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="canonical" value="0">
                    <input class="form-check-input" type="checkbox" name="canonical" id="canonical" value="1" {{ old('canonical', 0) == 1 || old('canonical') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="canonical">{{ trans('cruds.staticSeo.fields.canonical') }}</label>
                </div>
                @if($errors->has('canonical'))
                    <div class="invalid-feedback">
                        {{ $errors->first('canonical') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.canonical_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="html_schema_1">{{ trans('cruds.staticSeo.fields.html_schema_1') }}</label>
                <input class="form-control {{ $errors->has('html_schema_1') ? 'is-invalid' : '' }}" type="text" name="html_schema_1" id="html_schema_1" value="{{ old('html_schema_1', '') }}">
                @if($errors->has('html_schema_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_schema_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.html_schema_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="html_schema_2">{{ trans('cruds.staticSeo.fields.html_schema_2') }}</label>
                <input class="form-control {{ $errors->has('html_schema_2') ? 'is-invalid' : '' }}" type="text" name="html_schema_2" id="html_schema_2" value="{{ old('html_schema_2', '') }}">
                @if($errors->has('html_schema_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_schema_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.html_schema_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="html_schema_3">{{ trans('cruds.staticSeo.fields.html_schema_3') }}</label>
                <input class="form-control {{ $errors->has('html_schema_3') ? 'is-invalid' : '' }}" type="text" name="html_schema_3" id="html_schema_3" value="{{ old('html_schema_3', '') }}">
                @if($errors->has('html_schema_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_schema_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.html_schema_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="body_schema">{{ trans('cruds.staticSeo.fields.body_schema') }}</label>
                <input class="form-control {{ $errors->has('body_schema') ? 'is-invalid' : '' }}" type="text" name="body_schema" id="body_schema" value="{{ old('body_schema', '') }}">
                @if($errors->has('body_schema'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body_schema') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.body_schema_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook_description">{{ trans('cruds.staticSeo.fields.facebook_description') }}</label>
                <textarea class="form-control {{ $errors->has('facebook_description') ? 'is-invalid' : '' }}" name="facebook_description" id="facebook_description">{{ old('facebook_description') }}</textarea>
                @if($errors->has('facebook_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.facebook_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter_description">{{ trans('cruds.staticSeo.fields.twitter_description') }}</label>
                <textarea class="form-control {{ $errors->has('twitter_description') ? 'is-invalid' : '' }}" name="twitter_description" id="twitter_description">{{ old('twitter_description') }}</textarea>
                @if($errors->has('twitter_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.twitter_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meta_description">{{ trans('cruds.staticSeo.fields.meta_description') }}</label>
                <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                @if($errors->has('meta_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.staticSeo.fields.open_graph_type') }}</label>
                <select class="form-control {{ $errors->has('open_graph_type') ? 'is-invalid' : '' }}" name="open_graph_type" id="open_graph_type">
                    <option value disabled {{ old('open_graph_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StaticSeo::OPEN_GRAPH_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('open_graph_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('open_graph_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('open_graph_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.open_graph_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_image">{{ trans('cruds.staticSeo.fields.seo_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('seo_image') ? 'is-invalid' : '' }}" id="seo_image-dropzone">
                </div>
                @if($errors->has('seo_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seo_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.seo_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="menu_name">{{ trans('cruds.staticSeo.fields.menu_name') }}</label>
                <input class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}" type="text" name="menu_name" id="menu_name" value="{{ old('menu_name', '') }}">
                @if($errors->has('menu_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.menu_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_image_url">{{ trans('cruds.staticSeo.fields.seo_image_url') }}</label>
                <input class="form-control {{ $errors->has('seo_image_url') ? 'is-invalid' : '' }}" type="text" name="seo_image_url" id="seo_image_url" value="{{ old('seo_image_url', '') }}">
                @if($errors->has('seo_image_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seo_image_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.seo_image_url_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('noindex') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="noindex" value="0">
                    <input class="form-check-input" type="checkbox" name="noindex" id="noindex" value="1" {{ old('noindex', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="noindex">{{ trans('cruds.staticSeo.fields.noindex') }}</label>
                </div>
                @if($errors->has('noindex'))
                    <div class="invalid-feedback">
                        {{ $errors->first('noindex') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.noindex_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('nofollow') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="nofollow" value="0">
                    <input class="form-check-input" type="checkbox" name="nofollow" id="nofollow" value="1" {{ old('nofollow', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="nofollow">{{ trans('cruds.staticSeo.fields.nofollow') }}</label>
                </div>
                @if($errors->has('nofollow'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nofollow') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.nofollow_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('noimageindex') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="noimageindex" value="0">
                    <input class="form-check-input" type="checkbox" name="noimageindex" id="noimageindex" value="1" {{ old('noimageindex', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="noimageindex">{{ trans('cruds.staticSeo.fields.noimageindex') }}</label>
                </div>
                @if($errors->has('noimageindex'))
                    <div class="invalid-feedback">
                        {{ $errors->first('noimageindex') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.noimageindex_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('noarchive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="noarchive" value="0">
                    <input class="form-check-input" type="checkbox" name="noarchive" id="noarchive" value="1" {{ old('noarchive', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="noarchive">{{ trans('cruds.staticSeo.fields.noarchive') }}</label>
                </div>
                @if($errors->has('noarchive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('noarchive') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.noarchive_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('nosnippet') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="nosnippet" value="0">
                    <input class="form-check-input" type="checkbox" name="nosnippet" id="nosnippet" value="1" {{ old('nosnippet', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="nosnippet">{{ trans('cruds.staticSeo.fields.nosnippet') }}</label>
                </div>
                @if($errors->has('nosnippet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nosnippet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.nosnippet_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.seoImageDropzone = {
    url: '{{ route('admin.static-seos.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="seo_image"]').remove()
      $('form').append('<input type="hidden" name="seo_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="seo_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($staticSeo) && $staticSeo->seo_image)
      var file = {!! json_encode($staticSeo->seo_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="seo_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection