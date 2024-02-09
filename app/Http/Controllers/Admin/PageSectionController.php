<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPageSectionRequest;
use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Models\PageSection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PageSectionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('page_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PageSection::query()->select(sprintf('%s.*', (new PageSection)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'page_section_show';
                $editGate      = 'page_section_edit';
                $deleteGate    = 'page_section_delete';
                $crudRoutePart = 'page-sections';

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
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('section_title', function ($row) {
                return $row->section_title ? $row->section_title : '';
            });
            $table->editColumn('section', function ($row) {
                return $row->section ? $row->section : '';
            });
            $table->editColumn('section_nickname', function ($row) {
                return $row->section_nickname ? $row->section_nickname : '';
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published']);

            return $table->make(true);
        }

        return view('admin.pageSections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('page_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSections.create');
    }

    public function store(StorePageSectionRequest $request)
    {
        $pageSection = PageSection::create($request->all());

        return redirect()->route('admin.page-sections.index');
    }

    public function edit(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSections.edit', compact('pageSection'));
    }

    public function update(UpdatePageSectionRequest $request, PageSection $pageSection)
    {
        $pageSection->update($request->all());

        return redirect()->route('admin.page-sections.index');
    }

    public function show(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSections.show', compact('pageSection'));
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
