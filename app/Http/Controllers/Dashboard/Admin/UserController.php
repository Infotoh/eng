<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\UserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('dashboard.admin.users.index');

    }// end of index

    public function data()
    {
        $users = User::query();

        return DataTables::of($users)
            ->addColumn('record_select', 'dashboard.admin.users.data_table.record_select')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'dashboard.admin.users.data_table.actions')
            ->rawColumns(['record_select', 'roles', 'actions'])
            ->addIndexColumn()
            ->toJson();

    }// end of data

    public function create()
    {

        return view('dashboard.admin.users.create');

    }// end of create

    public function store(UserRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        $user = User::create($requestData);
        $user->attachRoles(['user', $request->role_id]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('user.users.index');

    }// end of store

    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['super_user', 'user'])->get();

        return view('user.users.edit', compact('user', 'roles'));

    }// end of edit

    public function update(userRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles(['user', $request->role_id]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('user.users.index');

    }// end of update

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);
            $this->delete($user);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }// end of delete

}//end of controller
