<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Helpers\Media;
use App\DataTables\ContactDataTable;

// Model
use App\Models\Contact;

class ContactController extends Controller
{
    public $view = 'contact.';
    public $route = 'contacts.';
    public $title = 'Kontak';
    public $subtitle = 'List Data Kontak';
    protected $path = 'upload/kontak';
    public $model;

    use Media;

    public function __construct(Contact $model)
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
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
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
            'email' => 'required|email',
            'no_wa' => 'required|numeric',
            'message' => 'required',
        ]);
    
        $input = $request->except('file');
        $file = $request->file('file');
        
        // Inisialisasi filePath dengan null
        $filePath = null;
        
        if ($file) {
            $uploadedFile = $this->processFile($file, $this->path);
            $filePath = $uploadedFile['filePath'] ?? null;
        }
        
        // Masukkan filePath ke dalam input jika tidak null
        if ($filePath) {
            $input['file'] = $filePath;
        }
        
        $result = $this->model->create($input);
    
        if ($result) {
            Alert::success('Berhasil', 'Data berhasil disimpan!');
            return redirect()->route('contact');
        }
     
        Alert::error('Gagal', 'Data gagal disimpan');
        return back()->with('error', 'Create ' . $this->title . ' Failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id' , $id)->first();
        return view($this->view.'detail' , [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id' , $id)->first();
        return view($this->view.'edit' , [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_rek' => 'required|numeric|digits:12',
            'no_wa' => 'required|numeric|digits:12',
            'address' => 'required',
            'file' => 'nullable|file|max:5120|mimes:png,jpg,jpeg',
        ]);
        

        $data = $this->model->findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('file')) {
            // Hapus gambar lama
            if ($data->image) {
                $this->deleteFile($data->image);
            }

            // Upload gambar baru
            $image = $this->processFile($request->file('file'), $this->path);
            $input['file'] = $image['filePath'];
        } else {
            $input['file'] = $data->image;
        }

        $result = $data->update($input);

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route.'index');
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
            'id' => 'required|exists:contacts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'ID tidak valid'], 400);
        }

        $data = $this->model->findOrFail($id);
        // Hapus gambar jika ada
        if ($data->file) {
            $this->deleteFile($data->file);
        }
        $result = $data->delete();
        if ($result) {
            return response()->json(['message' => 'Hapus ' . $this->title . ' Success'], 200);
        }

        return response()->json(['message' => 'Hapus ' . $this->title . ' Gagal'], 500);
    }

    private function processFile($file, $path)
    {
        if ($file) {
            $uploadedFile = $this->uploads($file, $path);
            // Pastikan uploadedFile adalah array dan memiliki key 'filePath'
            return [
                'filePath' => $uploadedFile['filePath'] ?? null
            ];
        }
        return [
            'filePath' => null
        ];
    }

    private function deleteFile($filePath)
    {
        $fileName = basename($filePath);
        $this->removeImage($fileName, $this->path);
    }
}
