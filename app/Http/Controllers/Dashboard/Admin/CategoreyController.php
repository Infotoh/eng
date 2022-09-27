<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\CategoreyRequest;
use Yajra\DataTables\DataTables;
use App\Models\Categorey;
use Illuminate\Http\Request;

class CategoreyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categoreys')->only(['index']);
        $this->middleware('permission:create_categoreys')->only(['create', 'store']);
        $this->middleware('permission:update_categoreys')->only(['edit', 'update']);
        $this->middleware('permission:delete_categoreys')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('dashboard.admin.categoreys.index');

    }//end of index

    public function data()
    {
        $categoreys = Categorey::query();

        return DataTables::of($categoreys)
            ->addColumn('record_select', 'dashboard.admin.categoreys.data_table.record_select')
            ->editColumn('created_at', function (Categorey $categorey) {
                return $categorey->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.categoreys.data_table.actions')
            ->rawColumns(['record_select', 'roles', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }// end of data

    public function create()
    {
        return view('dashboard.admin.categoreys.create');

    }//end of create


    public function store(CategoreyRequest $request)
    {
        Categorey::create($request->validated());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.admin.categoreys.index');

    }//end of store

    
    public function show(Categorey $categorey)
    {
        return view('dashboard.admin.categoreys.show', compact('categorey'));

    }//end of show

    
    public function edit(Categorey $categorey)
    {
        return view('dashboard.admin.categoreys.edit', compact('categorey'));

    }//en of edit


    public function update(Request $request, CategoreyRequest $categorey)
    {
        $categorey->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admin.categoreys.index');

    }//end of update

    public function destroy(Categorey $categorey)
    {
        $this->delete($categorey);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $categorey = Categorey::FindOrFail($recordId);
            $this->delete($categorey);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Categorey $categorey)
    {
        $categorey->delete();

    }// end of delete

}//end of controller