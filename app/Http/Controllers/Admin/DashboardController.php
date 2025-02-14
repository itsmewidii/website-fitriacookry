<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $datas = $this->calculate_counter($request);
        return view('dashboard.index' , compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function calculate_counter(Request $request)
    {
        $admin = Role::where('name', 'admin')->first();
        $admin = User::get();
        $transaction = Order::where('status' , 'SELESAI')->get();
        return [
            'admin' => $admin,
            'transaction' => $transaction,
        ];
    }
    
}
