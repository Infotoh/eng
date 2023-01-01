<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\CategoreyRequest;
use Yajra\DataTables\DataTables;
use App\Models\Categorey;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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

    public function data(Request $request)
    {

        $query = Consultation::query();
        $query->when($request->status,function($q) use ($request){
            return $q->where('categoreys_id',$request->status);
        });

        $categoreys = $query->get();

        return DataTables::of($categoreys)

            ->addColumn('number', function(Consultation $consulation) {return $consulation->number; })
            ->addColumn('name', function(Consultation $consulation) {return $consulation->name; })
            ->addColumn('record_select', 'dashboard.admin.categoreys.data_table.record_select')
            ->editColumn('created_at', function (Consultation $consultation) {
                return $consultation->created_at->format('Y-m-d');
            })
            ->editColumn('consultion', function (Consultation $consultation) {
                return Str::words($consultation->consultion, 5, '....');
            })
            ->addColumn('categorey', function (Consultation $consultation) {
                return $consultation->categorey->name ?? 'لاتوجد';
            })
            ->addColumn('actions', 'dashboard.admin.categoreys.data_table.actions')
            ->rawColumns(['actions','record_select'])
            ->setRowId('id')
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


    public function show($id)
    {
        $category = Consultation::findOrFail($id);
        return view('dashboard.admin.categoreys.show', compact('categorey'));

    }//end of show


    public function edit($id)
    {
        $category = Consultation::findOrFail($id);
        return view('dashboard.admin.categoreys.edit', compact('category'));

    }//en of edit


    public function update(Request $request,$id)
    {
        $category = Consultation::findOrFail($id);
        $request->validate([
            'comment' => 'required|string',
        ]);

        if($category->comment == null){
            $category->update($request->only('comment'));
            if($category->user->device_token != null){
                $token[0] = $category->user->device_token;
                fcmTopic($token,trans('site.title'),$category->comment);
            }
        }else{
            $category->update($request->only('comment'));
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();

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
