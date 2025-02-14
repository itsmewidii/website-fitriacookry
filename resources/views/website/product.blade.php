@extends('layouts.website.app')
@section('title', $title ?? 'Product')
@section('subtitle' , $subtitle ?? 'Product')
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

  <section class="section-pink" id="section-pink">

      <!-- open Menu Food -->
      <div class="container ">
        <div class="row">
            <div class="col-md-12 my-5">
                <h5 class="heading-five-menu-food">List Produk Lainnya</h5>
            </div>
            <div class="col-md-12">
              <div class="row justify-content-center">
                  @foreach($products as $product)
                  <div class="card-food col-6 col-md-6 col-lg-3 col-xl-3 col-sm-6 mb-4">
                    <div class="card card-salad-food text-center">
                        <img class="card-img-top"
                             src="{{ asset($product->image ?? 'template/base-website/assets/image/default-product.png') }}"
                             class="img-fluid"
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
                      {{--  <div class="col-md-3">
                          <div class="card card-salad-food text-center">
                              <img class="card-img-top"
                                   src="{{ asset($product->image ?? 'template/base-website/assets/image/default-product.png') }}"
                                   class="img-fluid"
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
                      </div>  --}}
                  @endforeach
              </div>
          </div>

        </div>
    </div>
    <!-- close Menu Food -->

  </section>
@endsection
