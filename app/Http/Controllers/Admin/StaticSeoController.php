<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStaticSeoRequest;
use App\Http\Requests\StoreStaticSeoRequest;
use App\Http\Requests\UpdateStaticSeoRequest;
use App\Models\StaticSeo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StaticSeoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('static_seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StaticSeo::query()->select(sprintf('%s.*', (new StaticSeo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'static_seo_show';
                $editGate      = 'static_seo_edit';
                $deleteGate    = 'static_seo_delete';
                $crudRoutePart = 'static-seos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('page_name', function ($row) {
                return $row->page_name ? $row->page_name : '';
            });
            $table->editColumn('meta_title', function ($row) {
                return $row->meta_title ? $row->meta_title : '';
            });
            $table->editColumn('content_type', function ($row) {
                return $row->content_type ? StaticSeo::CONTENT_TYPE_SELECT[$row->content_type] : '';
            });
            $table->editColumn('open_graph_type', function ($row) {
                return $row->open_graph_type ? StaticSeo::OPEN_GRAPH_TYPE_SELECT[$row->open_graph_type] : '';
            });
            $table->editColumn('menu_name', function ($row) {
                return $row->menu_name ? $row->menu_name : '';
            });
            $table->editColumn('noindex', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->noindex ? 'checked' : null) . '>';
            });
            $table->editColumn('nofollow', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->nofollow ? 'checked' : null) . '>';
            });
            $table->editColumn('noimageindex', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->noimageindex ? 'checked' : null) . '>';
            });
            $table->editColumn('noarchive', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->noarchive ? 'checked' : null) . '>';
            });
            $table->editColumn('nosnippet', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->nosnippet ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'noindex', 'nofollow', 'noimageindex', 'noarchive', 'nosnippet']);

            return $table->make(true);
        }

        return view('admin.staticSeos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('static_seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staticSeos.create');
    }

    public function store(StoreStaticSeoRequest $request)
    {
        $staticSeo = StaticSeo::create($request->all());

        if ($request->input('seo_image', false)) {
            $staticSeo->addMedia(storage_path('tmp/uploads/' . basename($request->input('seo_image'))))->toMediaCollection('seo_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $staticSeo->id]);
        }

        return redirect()->route('admin.static-seos.index');
    }

    public function edit(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staticSeos.edit', compact('staticSeo'));
    }

    public function update(UpdateStaticSeoRequest $request, StaticSeo $staticSeo)
    {
        $staticSeo->update($request->all());

        if ($request->input('seo_image', false)) {
            if (! $staticSeo->seo_image || $request->input('seo_image') !== $staticSeo->seo_image->file_name) {
                if ($staticSeo->seo_image) {
                    $staticSeo->seo_image->delete();
                }
                $staticSeo->addMedia(storage_path('tmp/uploads/' . basename($request->input('seo_image'))))->toMediaCollection('seo_image');
            }
        } elseif ($staticSeo->seo_image) {
            $staticSeo->seo_image->delete();
        }

        return redirect()->route('admin.static-seos.index');
    }

    public function show(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staticSeos.show', compact('staticSeo'));
    }

    public function destroy(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticSeo->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaticSeoRequest $request)
    {
        $staticSeos = StaticSeo::find(request('ids'));

        foreach ($staticSeos as $staticSeo) {
            $staticSeo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('static_seo_create') && Gate::denies('static_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StaticSeo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
