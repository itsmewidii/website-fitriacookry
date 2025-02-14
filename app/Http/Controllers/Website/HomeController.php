<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Model
use App\Models\Product;
use App\Models\Unique;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Regulation;
use App\Models\OrderCart;
use App\Models\Role;
use App\Models\User;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Helpers\Media;

class HomeController extends Controller
{
    protected $path_payment = '/uploads/proof_transfer';

    use Media;

    public function login()
    {
        return view('website.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $role = Role::where('name' , 'customer')->first();
        $user = User::where('email' , $request->email)->where('role_id' , $role->uuid)->first();
        if(!$user) {
            Alert::error('Error', 'Peran kredensial tidak valid');
            return redirect()->back();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            session(['customer' => Auth::guard('customer')->user()]);
            Alert::success('Berhasil', 'Login berhasil');
            return redirect()->route('index');
        }

        Alert::error('Error', 'Kredensial tidak valid');
        return redirect()->back();
    }
    
    public function registerStore(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            Alert::info('Gagal', 'Email sudah terdaftar, silakan gunakan email lain.');
            return back();
        }
    
        if (User::where('phone', $request->phone)->exists()) {
            Alert::info('Gagal', 'Nomor telepon sudah terdaftar, silakan gunakan nomor lain.');
            return back();
        }
    
        if (strlen($request->password) < 6) {
            Alert::info('Gagal', 'Password minimal harus 6 karakter.');
            return back();
        }

        if ($request->name == null) {
            Alert::info('Gagal', 'Nama Wajib di isi.');
            return back();
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);
    
        $customerRole = Role::where('name', 'customer')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $customerRole->uuid,
        ]);
    
        Alert::success('Berhasil', 'Pendaftaran berhasil');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Alert::info('Informasi', 'Berhasil logout');
        return redirect()->route('login');
    }


    public function index()
    {
        $meta_title = 'Beranda';
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();
        return view('website.index', compact('products', 'meta_title'));
    }

    public function product()
    {
        $meta_title = 'Produk';
        $products = Product::with('categorie')->get();
        return view('website.product', compact('products', 'meta_title'));
    }

    public function carts()
    {
        $meta_title = 'Keranjang';
        $regulation = Regulation::first();
        return view('website.cart' , compact('regulation', 'meta_title'));
    }

    public function contact()
    {
        $meta_title = 'Kontak';
        return view('website.contact', compact('meta_title'));
    }

    public function removeCarts($cart_id)
    {
        $cartItem = Cart::find($cart_id);

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ], 404);
        }

        $uniqueCode = $cartItem->user_id;
        Cart::where('product_id', $cartItem->product_id)->where('status' , 'pending')->delete();
        $cartItem->delete();

        $updatedCart = Cart::with('product.categorie')
            ->where('user_id', $uniqueCode)
            ->where('status', 'pending')
            ->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                $firstItem = $items->first();
                return [
                    'id' => $firstItem->id,
                    'product_id' => $firstItem->product_id,
                    'user_id' => $firstItem->user_id,
                    'qty' => $items->sum('qty'),
                    'total_price' => $items->sum('total_price'),
                    'product' => $firstItem->product,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully',
            'data' => $updatedCart->values(),
        ], 200);
    }

    public function GetCartByUnique($unique)
    {
        try {
            $data = Cart::with('product.categorie')
                ->where('user_id', $unique)
                ->where('status' , 'pending')
                ->get()
                ->groupBy('product_id')
                ->map(function ($items) {
                    $firstItem = $items->first();
                    return [
                        'id' => $firstItem->id,
                        'product_id' => $firstItem->product_id,
                        'user_id' => $firstItem->user_id,
                        'qty' => $items->sum('qty'),
                        'total_price' => $items->sum('total_price'),
                        'product' => $firstItem->product,
                    ];
                });

            if ($data->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data->values(),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $th->getMessage(),
            ], 500);
        }
    }


    public function PostCartByUnique(Request $request, $product_id)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required',
                'quantity' => 'required',
            ]);

            $product = Product::where('id', $product_id)->first();

            if (!$product) {
                Alert::info('informasi', 'Produk tidak ditemukan.');
                return redirect()->back();
            }

            $cart = Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $product->id,
                'qty' => $request->quantity,
                'total_price' => $product->price * $request->quantity
            ]);

            if($request->condition) {
                Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang.');
                return redirect()->route('carts');
            } else {
                Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang.');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Alert::info('informasi', 'Terjadi kesalahan, coba lagi.');
            return redirect()->back();
        }
    }


    public function detailProduct($id)
    {
        $products = Product::with('categorie')->findOrFail($id);
        $meta_title = 'Detail Produk';
        if (!$products->categorie) {
            \Log::warning("Produk ID {$id} tidak memiliki kategori terkait.");
        }
        $productList = Product::all();
        return view('website.detail-product', compact('products', 'productList', 'meta_title'));
    }

    // LOCATION
    public function GenerateLocation(Request $request)
    {
        try {
            $validated = $request->validate([
                'lat' => 'required',
                'long' => 'required',
            ]);

            $location = Unique::createUnique([
                'info' => json_encode($request->info) ?? '-',
                'lat'  => $request->lat,
                'long' => $request->long,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lokasi berhasil dibuat.',
                'data' => $location,
            ], 201);

        } catch (\Exception $e) {
            // Menangani error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat lokasi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getOrderByUnique($unique_id)
    {
        try {
            $user = User::where('id' , $unique_id)->first();
            $data = Order::where('user_id' , $user->id)->get();

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function UpdateLocation(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            $get = Unique::where('code', $request->code)->first();

            if ($get) {
                Unique::where('code', $request->code)->update([
                    'info' => json_encode($request->info) ?? '-',
                    'lat'  => $request->latitude,
                    'long' => $request->longitude,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Lokasi berhasil diperbarui.',
                    'data' => $get,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Lokasi tidak ditemukan.',
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui lokasi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkoutOrder(Request $request, $unique_id)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'whatsapp' => 'required',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'paymentProof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $uniqueData = User::where('id', $unique_id)->first();
        if (!$uniqueData) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }

        $file = $this->uploads($request->paymentProof, $this->path_payment);

        $order = Order::create([
            'user_id' => $uniqueData->id,
            'name' => $request->fullName,
            'no_whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'address' => $request->address,
            'proof_transfer' => $file['filePath'],
            'total_price' => 0,
            'total_qty' => 0,
        ]);

        $carts = Cart::where('user_id', $unique_id)->where('status', 'pending')->get();

        $totalPrice = 0;
        $totalQty = 0;

        foreach ($carts as $data_cart) {
            Cart::where('id', $data_cart->id)->update(['status' => 'checkout']);
            $updatedCart = Cart::find($data_cart->id);
            if ($updatedCart) {
                $totalPrice += $updatedCart->total_price;
                $totalQty += $updatedCart->qty;

                OrderCart::create([
                    'cart_id' => $updatedCart->id,
                    'order_id' => $order->id,
                ]);
            }
        }

        $order->update([
            'total_price' => $totalPrice,
            'total_qty' => $totalQty,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil!',
        ]);
    }

}
