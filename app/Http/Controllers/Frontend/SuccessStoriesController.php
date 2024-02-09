<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuccessStoryRequest;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\Service;
use App\Models\SuccessStory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SuccessStoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('success_story_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStories = SuccessStory::with(['services_useds', 'media'])->get();

        return view('frontend.successStories.index', compact('successStories'));
    }

    public function create()
    {
        abort_if(Gate::denies('success_story_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services_useds = Service::pluck('title', 'id');

        return view('frontend.successStories.create', compact('services_useds'));
    }

    public function store(StoreSuccessStoryRequest $request)
    {
        $successStory = SuccessStory::create($request->all());
        $successStory->services_useds()->sync($request->input('services_useds', []));
        if ($request->input('before', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('before'))))->toMediaCollection('before');
        }

        if ($request->input('after', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('after'))))->toMediaCollection('after');
        }

        if ($request->input('combined', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('combined'))))->toMediaCollection('combined');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $successStory->id]);
        }

        return redirect()->route('frontend.success-stories.index');
    }

    public function edit(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services_useds = Service::pluck('title', 'id');

        $successStory->load('services_useds');

        return view('frontend.successStories.edit', compact('services_useds', 'successStory'));
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory)
    {
        $successStory->update($request->all());
        $successStory->services_useds()->sync($request->input('services_useds', []));
        if ($request->input('before', false)) {
            if (! $successStory->before || $request->input('before') !== $successStory->before->file_name) {
                if ($successStory->before) {
                    $successStory->before->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('before'))))->toMediaCollection('before');
            }
        } elseif ($successStory->before) {
            $successStory->before->delete();
        }

        if ($request->input('after', false)) {
            if (! $successStory->after || $request->input('after') !== $successStory->after->file_name) {
                if ($successStory->after) {
                    $successStory->after->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('after'))))->toMediaCollection('after');
            }
        } elseif ($successStory->after) {
            $successStory->after->delete();
        }

        if ($request->input('combined', false)) {
            if (! $successStory->combined || $request->input('combined') !== $successStory->combined->file_name) {
                if ($successStory->combined) {
                    $successStory->combined->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('combined'))))->toMediaCollection('combined');
            }
        } elseif ($successStory->combined) {
            $successStory->combined->delete();
        }

        return redirect()->route('frontend.success-stories.index');
    }

    public function show(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStory->load('services_useds');

        return view('frontend.successStories.show', compact('successStory'));
    }

    public function destroy(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStory->delete();

        return back();
    }

    public function massDestroy(MassDestroySuccessStoryRequest $request)
    {
        $successStories = SuccessStory::find(request('ids'));

        foreach ($successStories as $successStory) {
            $successStory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('success_story_create') && Gate::denies('success_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuccessStory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
