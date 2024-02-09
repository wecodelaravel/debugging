@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.successStory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.success-stories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.successStory.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="story_about">{{ trans('cruds.successStory.fields.story_about') }}</label>
                <input class="form-control {{ $errors->has('story_about') ? 'is-invalid' : '' }}" type="text" name="story_about" id="story_about" value="{{ old('story_about', '') }}">
                @if($errors->has('story_about'))
                    <div class="invalid-feedback">
                        {{ $errors->first('story_about') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.story_about_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="story">{{ trans('cruds.successStory.fields.story') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('story') ? 'is-invalid' : '' }}" name="story" id="story">{!! old('story') !!}</textarea>
                @if($errors->has('story'))
                    <div class="invalid-feedback">
                        {{ $errors->first('story') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.story_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="before">{{ trans('cruds.successStory.fields.before') }}</label>
                <div class="needsclick dropzone {{ $errors->has('before') ? 'is-invalid' : '' }}" id="before-dropzone">
                </div>
                @if($errors->has('before'))
                    <div class="invalid-feedback">
                        {{ $errors->first('before') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.before_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="after">{{ trans('cruds.successStory.fields.after') }}</label>
                <div class="needsclick dropzone {{ $errors->has('after') ? 'is-invalid' : '' }}" id="after-dropzone">
                </div>
                @if($errors->has('after'))
                    <div class="invalid-feedback">
                        {{ $errors->first('after') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.after_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="combined">{{ trans('cruds.successStory.fields.combined') }}</label>
                <div class="needsclick dropzone {{ $errors->has('combined') ? 'is-invalid' : '' }}" id="combined-dropzone">
                </div>
                @if($errors->has('combined'))
                    <div class="invalid-feedback">
                        {{ $errors->first('combined') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.combined_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="services_useds">{{ trans('cruds.successStory.fields.services_used') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('services_useds') ? 'is-invalid' : '' }}" name="services_useds[]" id="services_useds" multiple>
                    @foreach($services_useds as $id => $services_used)
                        <option value="{{ $id }}" {{ in_array($id, old('services_useds', [])) ? 'selected' : '' }}>{{ $services_used }}</option>
                    @endforeach
                </select>
                @if($errors->has('services_useds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('services_useds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.successStory.fields.services_used_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.success-stories.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $successStory->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.beforeDropzone = {
    url: '{{ route('admin.success-stories.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 1800,
      height: 1800
    },
    success: function (file, response) {
      $('form').find('input[name="before"]').remove()
      $('form').append('<input type="hidden" name="before" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="before"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($successStory) && $successStory->before)
      var file = {!! json_encode($successStory->before) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="before" value="' + file.file_name + '">')
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
    Dropzone.options.afterDropzone = {
    url: '{{ route('admin.success-stories.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 1800,
      height: 1800
    },
    success: function (file, response) {
      $('form').find('input[name="after"]').remove()
      $('form').append('<input type="hidden" name="after" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="after"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($successStory) && $successStory->after)
      var file = {!! json_encode($successStory->after) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="after" value="' + file.file_name + '">')
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
    Dropzone.options.combinedDropzone = {
    url: '{{ route('admin.success-stories.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 1800,
      height: 1800
    },
    success: function (file, response) {
      $('form').find('input[name="combined"]').remove()
      $('form').append('<input type="hidden" name="combined" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="combined"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($successStory) && $successStory->combined)
      var file = {!! json_encode($successStory->combined) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="combined" value="' + file.file_name + '">')
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