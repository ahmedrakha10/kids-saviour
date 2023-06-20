<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view('admin.users.index');

    }// end of index

    public function data()
    {
        $users = User::where('type', 'user')->latest();

        return DataTables::of($users)
                         ->addColumn('record_select', 'admin.users.data_table.record_select')
                         ->editColumn('first_name', function (User $user) {
                             return $user->username;
                         })
                         ->editColumn('membership_level', function (User $user) {
                             return __($user->membership_level);
                         })
                         ->editColumn('status', function (User $user) {
                             return view('admin.users.data_table.status', compact('user'));
                         })
                         ->addColumn('package', function (User $user) {
                             return view('admin.users.data_table.package', compact('user'));
                         })
                         ->addColumn('image', function (User $user) {
                             return view('admin.users.data_table.image', compact('user'));
                         })
                         ->editColumn('created_at', function (User $user) {
                             return $user->created_at ? $user->created_at->format('Y-m-d') : '';
                         })
                         ->addColumn('actions', 'admin.users.data_table.actions')
                         ->rawColumns(['record_select', 'actions'])
                         ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.users.create');

    }// end of create

    public function store(UserRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        User::create($requestData);

        session()->flash('success', __('Added successfully'));
        return redirect()->route('admin.users.index');

    }// end of store

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }// end of edit

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));

    }// end of show

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.users.index');

    }// end of update

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);
            $this->delete($user);

        }//end of for each

        session()->flash('success', __('Deleted successfully'));
        return response(['text' => __('Deleted successfully')]);

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }// end of delete

    public function changeStatus(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();
        $data['status'] = 1;
        $data['message'] = __('Updated successfully');
        return response()->json($data);
    }

}//end of controller
