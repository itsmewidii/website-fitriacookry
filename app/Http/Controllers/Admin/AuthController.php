<?php

namespace App\Http\Controllers\Admin;

// LIBRARY LOCAL
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// MODELS
use App\Models\User;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;

// Event
use App\Events\MessageSent;

class AuthController extends Controller
{
    public $view = 'auth.';
    public $route = 'authentications.';
    public $title = 'Auth';
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        View::share('view', $this->view);
        View::share('route', $this->route);
        View::share('title', $this->title);
    }

    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        $meta_title = 'Login';
        return view('auth.login', compact('meta_title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function forgotPassword()
    {
        return view($this->view . 'forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route($this->route.'login');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ], [
            'email.exists' => 'Alamat email tidak ditemukan dalam data kami.'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            alert()->error('Validation Error', $errors->first())->persistent(true, false);
            return back();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('admin')->user();
            if ($user->role->name === 'admin') {
                session(['admin' => $user]);
                return redirect()->route('dashboard');
            } else {
                Alert::error('Access Denied', 'You do not have permission to access this page.')->persistent(true, false);
                Auth::guard('admin')->logout();
                return back();
            }
        }
    
        alert()->error('Access Denied', 'The provided credentials do not match our records.')->persistent(true, false);
        return back();
    }

    public function testEvent(Request $request)
    {
        $message = $request->query('message');
        broadcast(new MessageSent($message));
        return response()->json(['status' => 'Message Sent!']);
    }
}
