@extends('layouts.admin')
@section('content')
@can('static_seo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.static-seos.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StaticSeo">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('static_seo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.static-seos.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.static-seos.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'page_name', name: 'page_name' },
{ data: 'meta_title', name: 'meta_title' },
{ data: 'content_type', name: 'content_type' },
{ data: 'open_graph_type', name: 'open_graph_type' },
{ data: 'menu_name', name: 'menu_name' },
{ data: 'noindex', name: 'noindex' },
{ data: 'nofollow', name: 'nofollow' },
{ data: 'noimageindex', name: 'noimageindex' },
{ data: 'noarchive', name: 'noarchive' },
{ data: 'nosnippet', name: 'nosnippet' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StaticSeo').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection