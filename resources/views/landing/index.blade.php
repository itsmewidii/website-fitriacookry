<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitria Cookry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="/asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body>
    <!-- open navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-light">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="asset/image/logo-fitria-cookry.png" class="img-fluid" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  ms-auto ">
              <li class="nav-item mx-2">
                <a class="nav-link active" href="{{route('authentications.login')}}">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- close banner -->

      <!-- open banner -->
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="group-text-banner">
                    <h1 class="heading-one-banner"><span class="span-text-one">Enjoy food</span> all over the <span class="span-text-two">world</span></h1>
                    <p class="text-paragraf-banner">These healthy recipes shake up comfort food davorites by adding more veggies and shopping out cooking method</p>
                    <a href="{{route('authentications.login')}}">
                        <button type="button" class="btn button-banner">Get Started</button>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="asset/image/side.png" class="img-fluid image-banner" alt="">
            </div>
        </div>
      </div>
      <!-- close banner -->

      <section class="section-pink" id="section-pink">
        <!-- open our food -->
        <div class="container">
              <div class="row">
                <div class="col-md-12">
                    <h5 class="heading-our-text">Our Food</h5>
                    <p class="text-paragraf-our">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consectetur blandit proin velit scelerisque. Id justo, pellentesque diam blandit. At velit accumsan faucibus nullam erat ornare enim. Turpis urna, vitae ut sem cras vitae.</p>
                </div>
            </div>
          </div>
        <!-- clsoe our food -->

        <!-- open about -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 margin-top-about">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="./asset/image/image-about.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="group-text-about">
                                <h1 class="heading-one-about">The best quality For Your health</h1>
                                <p class="text-paragraf-about">These healthy recipes shake up comfort food davorites by adding more veggies and shopping out cooking method</p>
                                <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> Healthy and Nutritious</p>
                                <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> 
                                Material of Choice, Fresh</p>
                                <p class="text-point-paragraf-about"><i class="fas fa-check-circle icon-cheack"></i> Order Via Whatsapp</p>
                                <button class="btn button-about">View Food & Drink</button>
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
                    <h5 class="heading-five-menu-food">Menu Food & Drink</h5>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($produks as $produk)                        
                        <div class="col-md-3">
                                <div class="card card-salad-food text-center">
                                  <img class="card-img-top" src="{{$produk->image}}" class="img-fluid" alt="Title">
                                  <div class="card-body">
                                    <h4 class="card-name">{{$produk->name}}</h4>
                                    @if ($produk->status === 'active')
                                    <h4 class="card-price">Status : {{$produk->status}}</h4>
                                    @else
                                    <h4 class="card-name">Status : {{$produk->status}}</h4>
                                    @endif
                                    <p class="card-price">{{$produk->price}}</p>
                                    <button class="btn button-buy-in-card">Buy</button>
                                  </div>
                                </div>
                        </div>
                        @endforeach
                </div>
            </div>
            </div>
        </div>
        <!-- close Menu Food -->

        <!-- open contact page -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="custom-footer ">
          <p>&copy; 2025 Widya. Semua hak dilindungi.</p>
      </footer>
  

    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>