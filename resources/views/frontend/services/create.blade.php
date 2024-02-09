@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.service.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.services.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 ? 'checked' : '' }}>
                                <label for="published">{{ trans('cruds.service.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('published') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.service.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subtitle">{{ trans('cruds.service.fields.subtitle') }}</label>
                            <input class="form-control" type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', '') }}">
                            @if($errors->has('subtitle'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subtitle') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.subtitle_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="intro">{{ trans('cruds.service.fields.intro') }}</label>
                            <textarea class="form-control" name="intro" id="intro">{{ old('intro') }}</textarea>
                            @if($errors->has('intro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('intro') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.intro_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('cruds.service.fields.content') }}</label>
                            <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="banner">{{ trans('cruds.service.fields.banner') }}</label>
                            <div class="needsclick dropzone" id="banner-dropzone">
                            </div>
                            @if($errors->has('banner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('banner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.banner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="service_photo">{{ trans('cruds.service.fields.service_photo') }}</label>
                            <div class="needsclick dropzone" id="service_photo-dropzone">
                            </div>
                            @if($errors->has('service_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('service_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.service_photo_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.bannerDropzone = {
    url: '{{ route('frontend.services.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 1800,
      height: 500
    },
    success: function (file, response) {
      $('form').find('input[name="banner"]').remove()
      $('form').append('<input type="hidden" name="banner" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->banner)
      var file = {!! json_encode($service->banner) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.servicePhotoDropzone = {
    url: '{{ route('frontend.services.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="service_photo"]').remove()
      $('form').append('<input type="hidden" name="service_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="service_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->service_photo)
      var file = {!! json_encode($service->service_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="service_photo" value="' + file.file_name + '">')
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