<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\AdminRequest;
use App\Models\Role;
use App\Models\Admin;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin', 'user'])->get();
        return view('dashboard.admin.admins.index', compact('roles'));

    }// end of index

    public function data()
    {
        $admins = Admin::whereRoleIs('admin')->whenRoleId(request()->role_id);

        return DataTables::of($admins)
            ->addColumn('record_select', 'dashboard.admin.admins.data_table.record_select')
            ->addColumn('roles', function (Admin $admin) {
                return view('dashboard.admin.admins.data_table.roles', compact('admin'));
            })
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.admins.data_table.actions')
            ->rawColumns(['record_select', 'roles', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }// end of data

    public function create()
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();

        return view('dashboard.admin.admins.create', compact('roles'));

    }// end of create

    public function store(AdminRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        $admin = Admin::create($requestData);
        $admin->attachRoles(['admin', $request->role_id]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.admin.admins.index');

    }// end of store

    public function edit(Admin $admin)
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();

        return view('dashboard.admin.admins.edit', compact('admin', 'roles'));

    }// end of edit

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->validated());
        $admin->syncRoles(['admin', $request->role_id]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admin.admins.index');

    }// end of update

    public function destroy(Admin $admin)
    {
        $this->delete($admin);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admin = Admin::FindOrFail($recordId);
            $this->delete($admin);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Admin $admin)
    {
        $admin->delete();

    }// end of delete

}//end of controller
