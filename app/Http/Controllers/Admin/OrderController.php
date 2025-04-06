<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\User;
use App\Models\Unique;
use Illuminate\Support\Facades\DB;
use App\DataTables\OrderDataTable;
use App\Helpers\Media;

use Carbon\Carbon;

// Export
use App\Exports\Transaction\TemplateExport;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public $view = 'order.';
    public $route = 'orders.';
    public $title = 'Pesanan';
    public $subtitle = 'List Data Pesanan';
    protected $path = 'upload/order';
    public $model;

    use Media;

    public function __construct(Order $model)
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
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    public function orderStats(Request $request)
    {
        $range = $request->get('range', 'year');

        if ($range === 'month') {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
        } elseif ($range === 'week') {
            $startDate = now()->startOfWeek();
            $endDate = now()->endOfWeek();
        } else {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
        }

        if ($range === 'year') {
            $orders = Order::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $labels = $orders->pluck('month')->map(function ($month) {
                return \Carbon\Carbon::create()->month($month)->format('F'); 
            });

            $data = $orders->pluck('total')->map(function ($value) {
                return (int) $value;
            });
        } else {
            $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $labels = $orders->pluck('date')->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d M');
            });

            $data = $orders->pluck('total')->map(function ($value) {
                return (int) $value;
            });
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniques = Unique::all();
        return view($this->view . 'create', compact('uniques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unique_id' => 'required|exists:uniques,id',
            'unique_id' => 'required|exists:uniques,id',
            'no_whatsapp' => 'required',
            'email' => 'required|email',
            'total_qty' => 'required|numeric',
            'total_price' => 'required|numeric',
            'address' => 'required',
            'proof_transfer' => 'required|mimes:jpeg,png,jpg,pdf|max:5048',
        ]);

        $input = $request->all();

        // Handle file upload for proof_transfer
        if ($request->hasFile('proof_transfer')) {
            $uploadedFile = $this->uploads($request->file('proof_transfer'), 'proofs');
            $input['proof_transfer'] = $uploadedFile['filePath']; // Store file URL
        }

        // Create order with input data
        $result = $this->model->create($input);

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
        $uniques = User::all();
        $data = $this->model->with(['user', 'order_carts.cart.product'])->where('id', $id)->first();
    
        return view($this->view . 'detail', [
            'data' => $data,
            'user' => $uniques,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $uniques = User::all();
        $data = $this->model->with(['user', 'order_carts.cart.product'])->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data,
            'user' => $uniques,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'shipping_price' => 'required|numeric',
            'shipping_code' => 'required',
            'shipping' => 'required',
            'no_whatsapp' => 'required',
            'email' => 'required|email',
            'total_qty' => 'required|numeric',
            'total_price' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'proof_transfer' => 'nullable|mimes:jpeg,png,jpg,pdf|max:5048',
        ]);
    
        $input = $request->all();
    
        // if ($request->hasFile('proof_transfer')) {
        //     $existingOrder = $this->model->find($id);
        //     if ($existingOrder && $existingOrder->proof_transfer) {
        //         $this->removeImage($existingOrder->proof_transfer, $this->path);
        //     }
        //     $uploadedFile = $this->uploads($request->file('proof_transfer'), $this->path);
        //     if (isset($uploadedFile['filePath'])) {
        //         $input['proof_transfer'] = asset('storage/' . $uploadedFile['filePath']);
        //     } else {
        //         Alert::error('Error', 'File upload failed');
        //         return back()->withInput();
        //     }
        // }
    
        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'shipping_price' => $input['shipping_price'],
            'shipping_code' => $input['shipping_code'],
            'shipping' => $input['shipping'],
            'no_whatsapp' => $input['no_whatsapp'],
            'email' => $input['email'],
            'total_qty' => $input['total_qty'],
            'total_price' => $input['total_price'],
            'address' => $input['address'],
            'status' => $input['status'],
            // 'proof_transfer' => $input['proof_transfer'] ?? null, 
        ]);
    
        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
    
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }    

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'shipping_price' => 'required|numeric',
    //         'shipping_code' => 'required',
    //         'shipping' => 'required',
    //         'no_whatsapp' => 'required',
    //         'email' => 'required|email',
    //         'total_qty' => 'required|numeric',
    //         'total_price' => 'required|numeric',
    //         'address' => 'required',
    //         'status' => 'required',
    //         'proof_transfer' => 'nullable|mimes:jpeg,png,jpg,pdf|max:5048',
    //     ]);

    //     $input = $request->all();

    //     if ($request->hasFile('proof_transfer')) {
    //         $existingOrder = $this->model->find($id);
    //         if ($existingOrder && $existingOrder->proof_transfer) {
    //             $this->removeImage($existingOrder->proof_transfer, $this->path);
    //         }

    //         $uploadedFile = $this->uploads($request->file('proof_transfer'), $this->path);
    //         $input['proof_transfer'] = $uploadedFile['filePath'];
    //     }

    //     $result = $this->model->where('id', $id)->update($input);

    //     if ($result) {
    //         Alert::success('Updated', 'Update ' . $this->title . ' Success');
    //         return redirect()->route($this->route . 'index');
    //     }
    //     Alert::error('Updated', 'Update ' . $this->title . ' Failed');
    //     return back();
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order = $this->model->find($id);

        // Remove the proof of transfer image if exists
        if ($order && $order->proof_transfer) {
            $this->removeImage($order->proof_transfer, 'proofs');
        }

        // Delete the order
        $result = $order->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }

    public function uploads($file, $folder)
    {
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($folder, $filename, 'public');
        return ['filePath' => $filePath];
    }

    // public function export()
    // {
    //     $dateTime = Carbon::now()->format('d-M-Y-H:i');
    //     $filename = 'list-transaction-' . $dateTime . '.xlsx';
    //     return Excel::download(new TemplateExport, $filename);
    // }

    public function export()
{
    return Excel::download(new OrdersExport, 'orders.xlsx');
}
}
