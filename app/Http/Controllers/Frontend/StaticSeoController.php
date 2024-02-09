<?php

namespace App\Http\Controllers\Frontend;

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

class StaticSeoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('static_seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticSeos = StaticSeo::with(['media'])->get();

        return view('frontend.staticSeos.index', compact('staticSeos'));
    }

    public function create()
    {
        abort_if(Gate::denies('static_seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticSeos.create');
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

        return redirect()->route('frontend.static-seos.index');
    }

    public function edit(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticSeos.edit', compact('staticSeo'));
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

        return redirect()->route('frontend.static-seos.index');
    }

    public function show(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staticSeos.show', compact('staticSeo'));
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
