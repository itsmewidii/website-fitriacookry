<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Categorie;
use App\DataTables\ProductDataTable;
use App\Helpers\Media;

class ProductController extends Controller
{
    public $view = 'product.';
    public $route = 'products.';
    public $title = 'Produk';
    public $subtitle = 'List Data Produk';
    protected $path = 'upload/products';
    public $model;

    use Media;

    public function __construct(Product $model)
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
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all(); // Mengambil data kategori
        return view($this->view . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id', 
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'status' => 'required|in:active,non-active',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:5048', 
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $uploadedFile = $this->uploads($request->file('image'), 'products');
            $input['image'] = $uploadedFile['filePath'];
        }

        // Create product with input data
        $result = $this->model->create([
            'name' => $input['name'],
            'category_id' => $input['category_id'],
            'price' => $input['price'],
            'qty' => $input['qty'],
            'status' => $input['status'],
            'description' => $input['description'],
            'image' => $input['image'],
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
        $data = $this->model->where('id' , $id)->first();
        $categories = Categorie::all();
        return view($this->view.'detail' , [
            'categories' => $categories,
            'data' => $data
        ]);
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Categorie::all();
        $data = $this->model->with('categorie')->where('id', $id)->first();
    return view($this->view . 'edit', ['data' => $data, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'status' => 'required|in:active,non-active',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:5048', // Gambar opsional
        ]);
    
        $input = $request->all();
    
        $existingProduct = $this->model->find($id);
        if (!$existingProduct) {
            Alert::error('Error', 'Product not found');
            return back();
        }
    
        // Jika ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if (!empty($existingProduct->image)) {
                $oldImagePath = str_replace(url('/') . '/', '', $existingProduct->image); // Convert URL ke path relatif
                $this->removeImage($oldImagePath, 'products');
            }
    
            // Upload gambar baru
            $uploadedFile = $this->uploads($request->file('image'), 'products');
            $input['image'] = $uploadedFile['filePath'];
        } else {
            // Pertahankan gambar lama
            $input['image'] = $existingProduct->image;
        }
    
        // Update data produk
        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'category_id' => $input['category_id'],
            'price' => $input['price'],
            'qty' => $input['qty'],
            'status' => $input['status'],
            'description' => $input['description'],
            'image' => $input['image'], // Gambar baru atau lama
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
            'id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }
    
        $product = $this->model->find($id);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
    
        if ($product->image) {
            $this->removeImage($product->image, 'products');
        }
    
        $result = $this->model->where('id', $id)->forceDelete();
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        }
        
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }    

    // public function uploads($file, $folder)
    // {
    //     $uniqueName = uniqid('exe_file_') . '_' . time() . '.' . $file->getClientOriginalExtension();
    //     $subPath = 'storage/upload/' . $folder . '/';
    //     $fullPath = $subPath . $uniqueName;

    //     $file->move(public_path($subPath), $uniqueName);

    //     return [
    //         'filePath' => url($fullPath),
    //         'filename' => $uniqueName
    //     ];
    // }

    public function removeImage($filePath, $folder)
    {
        $fullPath = public_path(str_replace('storage/', '', $filePath));
        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}
