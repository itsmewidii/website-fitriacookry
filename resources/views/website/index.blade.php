@extends('layouts.website.app')
@section('title', $meta_title ?? 'Home')
@section('subtitle' , $subtitle ?? 'Home')
@section('head')
@endsection

@section('content')

<!-- open banner -->
<div class="container">
  <div class="row">
      <div class="col-md-6">
          <div class="group-text-banner">
              <h1 class="heading-one-banner"><span class="span-text-one">Nikmatnya Kue </span> dari Bahan <span class="span-text-two">Berkualitas</span></h1>
              <p class="text-paragraf-banner">Temukan berbagai resep sehat yang mengubah makanan favorit menjadi lebih bernutrisi dengan menambahkan lebih banyak bahan alami dan metode memasak yang lebih sehat.</p>
               <a href="{{ route('product') }}" style="line-height: 35px;" class="btn button-banner">Mulai Pembelian</a>
          </div>
      </div>
      <div class="col-md-6">
        <div class="img-layout">
            <img src="{{ asset('template/base-website/assets/image/side.png') }}" class="img-fluid image-banner" alt="side.png'">
        </div>
      </div>
  </div>
</div>
<!-- close banner -->

<!-- open about -->
<div class="container">
    <div class="row">
        <div class="layout-about col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-layout-about">
                        <img src="{{ asset('template/base-website/assets/image/image-about.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="group-text-about">
                        <h1 class="heading-one-about">Kualitas Terbaik untuk Kesehatan Anda</h1>
                        <p class="text-paragraf-about">Kami menghadirkan kue dengan bahan pilihan terbaik, segar, dan berkualitas tinggi untuk memastikan rasa yang lezat dan sehat.</p>
                        <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> Sehat dan Bergizi</p>
                        <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> Bahan Pilihan, Segar dan Berkualitas</p>
                        <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> Kemudahan Pemesanan</p>
                        <a href="{{ route('product') }}" class="btn button-about" style="line-height: 35px">Lihat Semua Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- close about -->

<!-- open Menu Food -->
<div class="container">
    <div class="row">
        <div class="col-md-12 margin-food">
            <h5 class="heading-five-menu-food">Produk Terbaru</h5>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                @forelse($products as $product)
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3 col-sm-6 mb-4">
                        <div class="card card-salad-food text-center">
                            <img class="card-img-top img-fluid" 
                                src="{{ asset($product->image ?? 'template/base-website/assets/image/default-product.png') }}" 
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h4 class="card-name">{{ $product->name }}</h4>
                                <p class="card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('product.detail', $product->id) }}" 
                                    class="btn p-2 button-buy-in-card">
                                    Beli
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada produk terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- close Menu Food -->

@endsection
