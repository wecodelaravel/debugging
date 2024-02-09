@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.settings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="facebook_link">{{ trans('cruds.setting.fields.facebook_link') }}</label>
                            <input class="form-control" type="text" name="facebook_link" id="facebook_link" value="{{ old('facebook_link', '') }}">
                            @if($errors->has('facebook_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facebook_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.facebook_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="twitter_link">{{ trans('cruds.setting.fields.twitter_link') }}</label>
                            <input class="form-control" type="text" name="twitter_link" id="twitter_link" value="{{ old('twitter_link', '') }}">
                            @if($errors->has('twitter_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('twitter_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.twitter_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="youtube_link">{{ trans('cruds.setting.fields.youtube_link') }}</label>
                            <input class="form-control" type="text" name="youtube_link" id="youtube_link" value="{{ old('youtube_link', '') }}">
                            @if($errors->has('youtube_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('youtube_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.youtube_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="short_bio">{{ trans('cruds.setting.fields.short_bio') }}</label>
                            <textarea class="form-control" name="short_bio" id="short_bio">{{ old('short_bio') }}</textarea>
                            @if($errors->has('short_bio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_bio') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.short_bio_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.setting.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.setting.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="avatar">{{ trans('cruds.setting.fields.avatar') }}</label>
                            <div class="needsclick dropzone" id="avatar-dropzone">
                            </div>
                            @if($errors->has('avatar'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('avatar') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.setting.fields.avatar_helper') }}</span>
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
    Dropzone.options.avatarDropzone = {
    url: '{{ route('frontend.settings.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 600,
      height: 600
    },
    success: function (file, response) {
      $('form').find('input[name="avatar"]').remove()
      $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="avatar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($setting) && $setting->avatar)
      var file = {!! json_encode($setting->avatar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
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