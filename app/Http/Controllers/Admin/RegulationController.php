<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Regulation;
use App\DataTables\ProductDataTable;
use App\Helpers\Media;

class RegulationController extends Controller
{
    public $view = 'regulation.';
    public $route = 'regulations.';
    public $title = 'Peraturan';
    public $subtitle = 'List Data Peraturan';
    protected $path = 'upload/regulation';
    public $model;

    use Media;

    public function __construct(Regulation $model)
    {
        $this->model = $model;
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->first();
        return view($this->view.'index' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required',
            // 'title' => 'required',
            // 'image' => 'nullable|file|max:5120|mimes:png,jpg,jpeg',
        ]);

        $data = $this->model->findOrFail($id);
        $input = $request->all();

        // if ($request->hasFile('image')) {
        //     // Hapus gambar lama
        //     if ($data->image) {
        //         $this->deleteFile($data->image);
        //     }

        //     // Upload gambar baru
        //     $image = $this->processFile($request->file('image'), $this->path);
        //     $input['image'] = $image['filePath'];
        // } else {
        //     $input['image'] = $data->image;
        // }

        $result = $data->update($input);

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route.'index');
        }
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }

    private function processFile($file, $path)
    {
        return $this->uploads($file, $path);
    }

    private function deleteFile($filePath)
    {
        $fileName = basename($filePath);
        $this->removeImage($fileName, $this->path);
    }
}
