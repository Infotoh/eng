<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ConsultationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:read_consultations')->only(['index']);
        $this->middleware('permission:create_consultations')->only(['create', 'store']);
        $this->middleware('permission:update_consultations')->only(['edit', 'update']);
        $this->middleware('permission:delete_consultations')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('dashboard.admin.consultations.index');

    }// end of index

    public function data()
    {
        $consultations = Consultation::all();

        return DataTables::of($consultations)
            ->addColumn('record_select', 'dashboard.admin.consultations.data_table.record_select')
            ->editColumn('created_at', function (Consultation $consultation) {
                return $consultation->created_at->format('Y-m-d');
            })
            ->editColumn('consultion', function (Consultation $consultation) {
                return Str::words($consultation->consultion, 5, '....');
            })
            ->addColumn('categorey', function (Consultation $consultation) {
                return $consultation->categorey->name;
            })
            ->addColumn('actions', 'dashboard.admin.consultations.data_table.actions')
            ->rawColumns(['record_select', 'roles', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }// end of data


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
