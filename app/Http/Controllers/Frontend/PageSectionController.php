<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPageSectionRequest;
use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Models\PageSection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageSectionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('page_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSections = PageSection::all();

        return view('frontend.pageSections.index', compact('pageSections'));
    }

    public function create()
    {
        abort_if(Gate::denies('page_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pageSections.create');
    }

    public function store(StorePageSectionRequest $request)
    {
        $pageSection = PageSection::create($request->all());

        return redirect()->route('frontend.page-sections.index');
    }

    public function edit(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pageSections.edit', compact('pageSection'));
    }

    public function update(UpdatePageSectionRequest $request, PageSection $pageSection)
    {
        $pageSection->update($request->all());

        return redirect()->route('frontend.page-sections.index');
    }

    public function show(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pageSections.show', compact('pageSection'));
    }

    public function destroy(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSection->delete();

        return back();
    }

    public function massDestroy(MassDestroyPageSectionRequest $request)
    {
        $pageSections = PageSection::find(request('ids'));

        foreach ($pageSections as $pageSection) {
            $pageSection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
