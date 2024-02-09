@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('static_seo_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.static-seos.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.staticSeo.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.staticSeo.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-StaticSeo">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.page_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.meta_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.content_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.open_graph_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.menu_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.noindex') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.nofollow') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.noimageindex') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.noarchive') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.staticSeo.fields.nosnippet') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staticSeos as $key => $staticSeo)
                                    <tr data-entry-id="{{ $staticSeo->id }}">
                                        <td>
                                            {{ $staticSeo->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staticSeo->page_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staticSeo->meta_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\StaticSeo::CONTENT_TYPE_SELECT[$staticSeo->content_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\StaticSeo::OPEN_GRAPH_TYPE_SELECT[$staticSeo->open_graph_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $staticSeo->menu_name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $staticSeo->noindex ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noindex ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $staticSeo->nofollow ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $staticSeo->nofollow ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $staticSeo->noimageindex ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noimageindex ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $staticSeo->noarchive ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $staticSeo->noarchive ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $staticSeo->nosnippet ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $staticSeo->nosnippet ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('static_seo_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.static-seos.show', $staticSeo->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('static_seo_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.static-seos.edit', $staticSeo->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('static_seo_delete')
                                                <form action="{{ route('frontend.static-seos.destroy', $staticSeo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('static_seo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.static-seos.massDestroy') }}",
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
  let table = $('.datatable-StaticSeo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection