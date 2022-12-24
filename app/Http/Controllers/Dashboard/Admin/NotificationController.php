<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\CategoreyRequest;
use Yajra\DataTables\DataTables;
use App\Models\Categorey;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function __construct()
    {

    }// end of __construct

    public function index()
    {
        return view('dashboard.admin.notifications.index');

    }//end of index

    public function data(Request $request)
    {
        
         $query = Consultation::whereNull('comment')->get();
         return DataTables::of($query)
            ->addColumn('number', function(Consultation $consulation) {return $consulation->number; })
            ->addColumn('name', function(Consultation $consulation) {return $consulation->name; })
            ->editColumn('created_at', function (Consultation $consultation) {
                return $consultation->created_at->format('Y-m-d');
            })
            ->editColumn('consultion', function (Consultation $consultation) {
                return Str::words($consultation->consultion, 5, '....');
            })
            ->addColumn('categorey', function (Consultation $consultation) {
                return $consultation->categorey->name ?? 'لاتوجد';
            })
            ->addColumn('record_select', 'dashboard.admin.categoreys.data_table.record_select')
            ->addColumn('actions', 'dashboard.admin.categoreys.data_table.actions')
            ->rawColumns(['actions','record_select'])
            ->setRowId('id')
            ->toJson();


    }// end of data

    public function show($id)
    {
        $category = Consultation::findOrFail($id);
        return view('dashboard.admin.categoreys.show', compact('categorey'));

    }//end of show


}//end of controller