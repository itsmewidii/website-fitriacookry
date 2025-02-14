@extends('layouts.dashboard.app')
@section('title', $title ?? 'Order')
@section('subtitle' , 'Detail ' . $title)
@section('head')

@endsection
@section('script')
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/table.js') }}"></script>
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/export-users.js')}}"></script>
<script src="{{ asset('template/base-admin/src/js/custom/apps/dashboard/product/add.js')}}"></script>
@endsection
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <!--begin::Card header-->
        
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <div class="card border-0 shadow text-center">
                                                <div class="card-body text-center">
                                                    <h1 class="text-center mb-3">Bukti Transfer</h1>
                                                    @if($data->proof_transfer)
                                                    <img src="{{ $data->proof_transfer }}" class="" style="height: auto; width: 100%; object-fit: cover" alt="" id="image-review">
                                                    @else
                                                    <img src="{{ asset('assets/pipper/logo-circle.png') }}" id="image-review" style="height: auto; width: 100%; object-fit: cover" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->
                </div>
            </div>

            {{--  Data Product  --}}
            <div class="col-12">
                <div class="card mb-5">
                    <!--begin::Card header-->
        
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data->order_carts as $data_order)
                                <div class="col-md-6 mb-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-4">
                                                <img src="{{ $data_order->cart->product->image }}" 
                                                     alt="{{ $data_order->cart->product->name }}" 
                                                     class="img-fluid rounded" 
                                                     style="width: 180px; height: 180px; object-fit: contain;">
                                            </div>
                    
                                            <div class="flex-grow-1 p-1">
                                                <table class="table table-bordered table-striped table-hover align-middle p-5">
                                                    <tbody>
                                                        <tr>
                                                            <th class="bg-light text-dark w-35 p-3">Nama Produk <span class="text-end">:</span></th>
                                                            <td class="bg-light text-dark">{{ $data_order->cart->product->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light text-dark w-35 p-3">Kategori <span class="text-end">:</span></th>
                                                            <td class="bg-light text-dark">{{ $data_order->cart->product->categorie->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light text-dark w-35 p-3">Harga Total <span class="text-end">:</span></th>
                                                            <td class="bg-light text-dark">Rp {{ number_format($data_order->cart->total_price, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light text-dark w-35 p-3">Jumlah <span class="text-end">:</span></th>
                                                            <td class="bg-light text-dark">{{ $data_order->cart->qty }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>                                                                                                     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-5">
                    <!--begin::Card header-->
        
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                        <div class="card-body">
                            <div class="row">
                                <!-- Name Input -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
                                    <div class="position-relative mb-3">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" readonly placeholder="Input Name" />
                                        @error('name')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- WhatsApp Number Input -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label role="no_whatsapp" class="form-label fw-bolder text-dark fs-6">Nomer WhatsApp</label>
                                    <div class="position-relative mb-3">
                                        <input type="number" name="no_whatsapp" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->no_whatsapp : '' }}" readonly placeholder="Input WhatsApp Number" />
                                        @error('no_whatsapp')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Email Input -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label role="email" class="form-label fw-bolder text-dark fs-6">Email</label>
                                    <div class="position-relative mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->email : '' }}" readonly placeholder="Input Email" />
                                        @error('email')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Total Quantity Input -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label role="total_qty" class="form-label fw-bolder text-dark fs-6">Jumlah total</label>
                                    <div class="position-relative mb-3">
                                        <input type="number" name="total_qty" class="form-control form-control-lg form-control-solid" 
                                        value="{{ isset($data) ? $data->total_qty : '' }}" readonly placeholder="Input Total Quantity" />
                                        @error('total_qty')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Total Price Input -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label role="total_price" class="form-label fw-bolder text-dark fs-6">Total harga</label>
                                    <div class="position-relative mb-3">
                                        <input type="number" name="total_price" class="form-control form-control-lg form-control-solid"
                                        value="{{ isset($data) ? $data->total_price : '' }}" readonly placeholder="Input Total Price" />
                                        @error('total_price')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
        
                                <!-- Status Selection -->
                                <div class="form-group col-md-6 fv-row mb-3">
                                    <label for="status" class="form-label fw-bolder text-dark fs-6">Status</label>
                                    <div class="position-relative mb-3">
                                        <select name="status" id="status" class="form-control form-control-lg form-control-solid" disabled>
                                            @php
                                                $statuses = ['PENDING', 'PROSES', 'DIKIRIM', 'SELESAI'];
                                            @endphp
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}" 
                                                    {{ isset($order) && $order->status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst(strtolower($status)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Address Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="address" class="form-label fw-bolder text-dark fs-6">Alamat</label>
                                    <div class="position-relative mb-3">
                                        <textarea name="address" class="form-control form-control-lg form-control-solid" rows="4" readonly placeholder="Input Address">{{ isset($data) ? $data->address : old('address') }}</textarea>
                                        @error('address')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->
                </div>
            </div>


        <div class="card">
            <!--begin::Card header-->

            <!--end::Card header-->
            <!--begin::Card body-->
            <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                <div class="card-body">
                    <div class="row">
                        <!-- Shipping Method Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label for="shipping" class="form-label fw-bolder text-dark fs-6">Ekspedisi</label>
                            <div class="position-relative mb-3">
                                <select name="shipping" id="shipping" class="form-control form-control-lg form-control-solid" disabled>
                                    <option value="Fitria Cookry" {{ isset($data) && $data->shipping == 'Fitria Cookry' ? 'selected' : '' }}>Fitria Cookry</option>
                                    <option value="JNE" {{ isset($data) && $data->shipping == 'JNE' ? 'selected' : '' }}>JNE</option>
                                    <option value="Lion Parcel" {{ isset($data) && $data->shipping == 'Lion Parcel' ? 'selected' : '' }}>Lion Parcel</option>
                                    <option value="SiCepat" {{ isset($data) && $data->shipping == 'SiCepat' ? 'selected' : '' }}>SiCepat</option>
                                    <option value="Sap Xpress" {{ isset($data) && $data->shipping == 'Sap Xpress' ? 'selected' : '' }}>SAP Express</option>
                                    <option value="Anteraja" {{ isset($data) && $data->shipping == 'Anteraja' ? 'selected' : '' }}>Anteraja</option>
                                    <option value="J&T Express" {{ isset($data) && $data->shipping == 'J&T Express' ? 'selected' : '' }}>J&T Express</option>
                                    <option value="Paxel" {{ isset($data) && $data->shipping == 'Paxel' ? 'selected' : '' }}>Paxel</option>
                                    <option value="Grabe Xpress" {{ isset($data) && $data->shipping == 'Grabe Xpress' ? 'selected' : '' }}>GrabExpress</option>
                                    <option value="Ninja Express" {{ isset($data) && $data->shipping == 'Ninja Express' ? 'selected' : '' }}>Ninja Express</option>
                                    <option value="Troben" {{ isset($data) && $data->shipping == 'Troben' ? 'selected' : '' }}>Troben</option>
                                    <option value="Gosend" {{ isset($data) && $data->shipping == 'Gosend' ? 'selected' : '' }}>GoSend</option>
                                </select>
                                @error('shipping')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">
                                        {{ $message }} !
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Shipping Price Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label role="shipping_price" class="form-label fw-bolder text-dark fs-6">Harga Ongkir</label>
                            <div class="position-relative mb-3">
                                <input type="number" name="shipping_price" class="form-control form-control-lg form-control-solid"
                                    value="{{ isset($data) ? $data->shipping_price : '' }}" readonly placeholder="Input Shipping Price" />
                                @error('shipping_price')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Shipping Code Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label role="shipping_code" class="form-label fw-bolder text-dark fs-6">Nomer Resi</label>
                            <div class="position-relative mb-3">
                                <input type="text" name="shipping_code" class="form-control form-control-lg form-control-solid"
                                    value="{{ isset($data) ? $data->shipping_code : '' }}" readonly placeholder="Input Shipping Code" />
                                @error('shipping_code')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
</div>
@endsection
