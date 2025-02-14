<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;

// Models
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use App\DataTables\UsersDataTable;

class AdminController extends Controller
{
    public $view = 'admin.';
    public $route = 'admins.';
    public $title = 'Admin Account';
    public $subtitle = 'List Data Admin Account';
    public $model;

    public function __construct(User $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        View::share('subtitle', $this->subtitle);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->with(['role' => 'admin'])->render($this->view . 'index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|regex:/^(?=.*[A-Z]).*$/',
        ], [
            'password.regex' => 'Password minimal harus Huruf besar 1 karakter.'
        ]);

        $input = $request->all();

        $role = Role::where('name', 'admin')->first();
        // $role = 'admin';

        if (!$role) {
            Alert::error('Error', 'Role Admin Branch tidak ditemukan.');
            return back();
        }

        $result = $this->model->create([
            'role_id' => $role->uuid,
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        if ($result) {
            $result->assignRole($role->name);
            Alert::success('Created', 'Create ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Created', 'Create ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
        ]);

        if ($request->password) {
            $this->model->where('id', $id)->update([
                'password' => Hash::make($input['password'])
            ]);
        }

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }
        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }
}
