<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Unique;

use App\DataTables\UniqueDataTable;

class UniqueController extends Controller
{
    public $view = 'unique.';
    public $route = 'uniques.';
    public $title = 'Pengakses';
    public $subtitle = 'List Data Pengakses';
    public $model;

    public function __construct(Unique $model)
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
    public function index(UniqueDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniques = Unique::all();
        return view($this->view . 'create' , compact('uniques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:uniques,code',
            'info' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $input = $request->all();


        $result = $this->model->create([
            'code' => $input['code'],
            'info' => $input['info'],
            'lat' => $input['lat'],
            'long' => $input['long'],
        ]);

        if ($result) {
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
            'code' => 'required|unique:uniques,code',
            'info' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'code' => $input['code'],
            'info' => $input['info'],
            'lat' => $input['lat'],
            'long' => $input['long'],
        ]);

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
            'id' => 'required|exists:uniques,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }

        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => $this->title . ' successfully deleted'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }
}
