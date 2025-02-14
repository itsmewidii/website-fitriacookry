@extends('layouts.website.app')
@section('title', $title ?? 'Detail Product')
@section('subtitle', $subtitle ?? 'Detail Product')
@section('head')
@endsection

@section('content')
    <!-- open banner -->
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 product-image margin-top-about">
                <div class="bg-color p-3 m-3">
                    <img src="{{ $products->image }}" alt="{{ $products->name }}">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6 product-details margin-top-about">
                <h1 class="product-title">{{ $products->name }}</h1>
                <h1 class="product-price">Rp {{ number_format($products->price, 0, ',', '.') }}</h1>
                <ul class="horizontal-list mx-3">
                    <li class="m-3">Tersisa {{ $products->qty }} pcs</li>
                    <li class="m-3">{{ $products->categorie->name }}</li>
                </ul>

                <p class="text-p">
                    {{ $products->description }}
                </p>

                <!-- Button trigger modal -->
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="mb-5">
                            <label for="" class="fw-bold mb-2">Masukan Jumlah Product</label>
                            <input type="number" name="quantity" class="form-control text-center" id="quantity" style="width: 20%" value="1">
                            {{-- <input type="number" name="quantity" class="form-control text-center" id="quantity" style="width: 20%"> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('carts.post', $products->id) }}" method="post" enctype="multipart/form-data" class="h-100">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="quantity" class="form-control text-center" id="quantity-buy" style="width: 20%" value="1">
                            <input type="hidden" class="form-control" name="user_id" id="user-buy" value="{{ auth('customer')->user()->id }}">
                            <input type="hidden" class="form-control" name="condition" value="buy">
                            <button type="submit" class="btn mb-2 btn-buy w-100 fw-bold h-100">
                                Beli
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('carts.post', $products->id) }}" method="post" enctype="multipart/form-data" class="h-100">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="quantity" class="form-control text-center" id="quantity-cart" style="width: 20%" value="1">
                            <input type="hidden" class="form-control" name="user_id" id="user-cart" value="{{ auth('customer')->user()->id }}">
                            <button type="submit" class="btn mb-2 btn-primary h-100 rounded-0 text-white fw-bold w-100">
                                + Masukan Keranjang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-radius">
                            <div class="modal-header">
                                <h5 class="modal-title" id="saladModalLabel">Salad Food 13ml</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="horizontal-list">
                                    <p class="m-3 ">Rp 14.000,00</p>
                                    <li class="mx-3 my-3">Makanan</li>
                                </ul>
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control border-radius" placeholder="Nama">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control border-radius" placeholder="No. Whatsapp">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control border-radius" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control border-radius"
                                            placeholder="Jumlah Pembelian">
                                    </div>
                                    <button type="button" class="btn-success w-100">Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        @foreach ($productList as $product)
                            <div class="col-md-3">
                                <div class="card card-salad-food text-center">
                                    <img class="card-img-top"
                                        src="{{ asset($product->image ?? 'template/base-website/assets/image/default-product.png') }}"
                                        class="img-fluid" alt="{{ $product->name }}">
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- close Menu Food -->
    </section>

@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deviceId = getCookie('device_id');
            if (deviceId) {
                document.getElementById('unique_id').value = deviceId;
                document.getElementById('unique_id_first').value = deviceId;
            } else {
                console.log("unique_id tidak ditemukan di cookie.");
            }
        });

         // Set default quantity to 1
        var inputInitial = document.getElementById('quantity');
        var inputBuy = document.getElementById('quantity-buy');
        var inputCart = document.getElementById('quantity-cart');
        if (inputInitial) {
            inputInitial.value = 1;
        }
        inputInitial.addEventListener('input', function() {
            inputBuy.value = inputInitial.value;
            inputCart.value = inputInitial.value;
        });

    </script>
@endsection
