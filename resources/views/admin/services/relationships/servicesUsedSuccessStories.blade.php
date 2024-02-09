@can('success_story_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.success-stories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.successStory.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.successStory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-servicesUsedSuccessStories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.successStory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.successStory.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.successStory.fields.story_about') }}
                        </th>
                        <th>
                            {{ trans('cruds.successStory.fields.services_used') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($successStories as $key => $successStory)
                        <tr data-entry-id="{{ $successStory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $successStory->id ?? '' }}
                            </td>
                            <td>
                                {{ $successStory->title ?? '' }}
                            </td>
                            <td>
                                {{ $successStory->story_about ?? '' }}
                            </td>
                            <td>
                                @foreach($successStory->services_useds as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('success_story_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.success-stories.show', $successStory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('success_story_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.success-stories.edit', $successStory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('success_story_delete')
                                    <form action="{{ route('admin.success-stories.destroy', $successStory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('success_story_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.success-stories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-servicesUsedSuccessStories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection