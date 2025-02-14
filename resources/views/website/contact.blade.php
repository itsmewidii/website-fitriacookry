@extends('layouts.website.app')
@section('title', $meta_title ?? 'Kontak')
@section('subtitle', $subtitle ?? 'Kontak')
@section('head')
@endsection

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endsection

@section('content')
    <!-- open banner -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="group-text-banner">
                    <h1 class="heading-one-banner"><span class="span-text-one">Nikmatnya Kue </span> dari Bahan <span
                            class="span-text-two">Berkualitas</span></h1>
                    <p class="text-paragraf-banner">Temukan berbagai resep sehat yang mengubah makanan favorit menjadi lebih
                        bernutrisi dengan menambahkan lebih banyak bahan alami dan metode memasak yang lebih sehat.</p>
                    <a href="{{ route('product') }}" style="line-height: 35px;" class="btn button-banner">Mulai Pembelian</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-layout">
                    <img src="{{ asset('template/base-website/assets/image/side.png') }}" class="img-fluid image-banner"
                        alt="side.png'">
                </div>
            </div>
        </div>
    </div>
    <!-- close banner -->

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" style="margin-top: 150px">
                    <h1 class="fw-bold text-dark mb-3">Masukan Saran <br> Anda!</h1>
                </div>

                <div class="col-12">
                    <div class="card-request-cs">
                        <div class="card-body">
                            <form method="POST" action="{{ route('contacts.store') }}" class="needs-validation"
                                enctype="multipart/form-data" id="xss-validation">
                                {{--  <form method="POST" action="" class="needs-validation" enctype="multipart/form-data" id="xss-validation">  --}}
                                @csrf
                                <div class="row">
                                    <!-- Nama -->
                                    <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="name" class="form-label"><strong>Nama Lengkap</strong></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap">
                                        @error('name')
                                            <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">
                                                {{ $message }}!</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="email" class="form-label"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Masukan Alamat Email">
                                        @error('email')
                                            <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">
                                                {{ $message }}!</p>
                                        @enderror
                                    </div>

                                    <!-- Nomor WhatsApp -->
                                    <div class="form-group-cs col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="no_wa" class="form-label"><strong>Nomor WhatsApp</strong></label>
                                        <div class="input-group">
                                            <input type="text" name="no_wa" id="no_wa" class="form-control"
                                                value="{{ old('no_wa') }}" placeholder="Masukkan No Telepon">
                                        </div>
                                        @error('no_wa')
                                            <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">
                                                {{ $message }}!</p>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group-cs col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="message" class="form-label"><strong>Pesan</strong></label>
                                        <textarea name="message" class="form-control" id="message" rows="5">{{ old('message') }}</textarea>
                                        @error('message')
                                            <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">
                                                {{ $message }}!</p>
                                        @enderror
                                    </div>

                                    <!-- File -->


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success rounded mt-4">Kirim</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- Memuat CKEditor dari CDN -->
    <script>
        ClassicEditor
            .create(document.querySelector('#address'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
