@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('product_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.product-types.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.productType.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.productType.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProductType">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productType.fields.published') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productType.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productType.fields.photos') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productTypes as $key => $productType)
                                    <tr data-entry-id="{{ $productType->id }}">
                                        <td>
                                            {{ $productType->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $productType->published ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $productType->published ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $productType->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($productType->photos)
                                                <a href="{{ $productType->photos->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $productType->photos->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('product_type_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.product-types.show', $productType->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('product_type_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.product-types.edit', $productType->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('product_type_delete')
                                                <form action="{{ route('frontend.product-types.destroy', $productType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.product-types.massDestroy') }}",
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
  let table = $('.datatable-ProductType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection