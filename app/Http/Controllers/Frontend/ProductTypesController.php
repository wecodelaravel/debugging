<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductTypeRequest;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductTypesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productTypes = ProductType::with(['media'])->get();

        return view('frontend.productTypes.index', compact('productTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productTypes.create');
    }

    public function store(StoreProductTypeRequest $request)
    {
        $productType = ProductType::create($request->all());

        if ($request->input('photos', false)) {
            $productType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productType->id]);
        }

        return redirect()->route('frontend.product-types.index');
    }

    public function edit(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productTypes.edit', compact('productType'));
    }

    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        $productType->update($request->all());

        if ($request->input('photos', false)) {
            if (! $productType->photos || $request->input('photos') !== $productType->photos->file_name) {
                if ($productType->photos) {
                    $productType->photos->delete();
                }
                $productType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($productType->photos) {
            $productType->photos->delete();
        }

        return redirect()->route('frontend.product-types.index');
    }

    public function show(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productTypes.show', compact('productType'));
    }

    public function destroy(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productType->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductTypeRequest $request)
    {
        $productTypes = ProductType::find(request('ids'));

        foreach ($productTypes as $productType) {
            $productType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_type_create') && Gate::denies('product_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
