@extends('layouts.website.auth')
@section('title', $meta_title ?? 'Home')
@section('subtitle', $subtitle ?? 'Home')

@section('content')
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('login.store') }}" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class='bx bxs-envelope' ></i>
                        <input name="email" type="email" placeholder="Email">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt' ></i>
                        <input name="password" type="password" placeholder="Kata Sandi">
                    </div>
                    <input type="submit" value="Login" class="btn solid">
                </form>
                <form action="{{ route('register.store') }}" class="sign-up-form">
                    @csrf
                    <h2 class="title">Daftar</h2>
                    <div class="input-field">
                        <i class='bx bxs-user' ></i>
                        <input name="name" type="text" placeholder="Nama">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-envelope' ></i>
                        <input name="email" type="email" placeholder="Email">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-phone'></i>
                        <input name="phone" type="number" placeholder="No. Telepon">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt' ></i>
                        <input name="password" type="password" placeholder="Kata Sandi">
                    </div>
                    <input type="submit" class="btn" value="Daftar">
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Login</h3>
                    <p>
                        Masukan Data untuk melakukan login !
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Daftar?
                    </button>
                </div>
                <img  src="{{ asset('asset/image/login.svg') }}" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Pendaftaran</h3>
                    <p>
                        Masukan Data Lengkap anda untuk melakukan pendaftaran
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Login
                    </button>
                </div>
                <img src="{{ asset('asset/image/singup.svg') }}" class="image" alt="">
            </div>
        </div>
    </div>

@endsection
