@extends('layouts.dashboard.app')
@section('title', $title ?? 'Detail Kontak')
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
        <div class="card">
            <!--begin::Card header-->

            <!--end::Card header-->
            <!--begin::Card body-->
            <form method="POST" action="#" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                @if($data->file)
                                <img src="{{ $data->file }}" class="img-fluid" alt="" id="image-review">
                                @else
                                <img src="{{ asset('asset_admin/assets/image/example/example.jpg') }}" id="image-review" class="img-fluid" alt="">
                                @endif
                            </div>
                      </div>
                    </div>
    
                    <div class="col-lg-8">
                        <div class="card-body">
                            <div class="row">
                                <!-- Nama -->
                                <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="name" class="form-label"><strong>Nama Lengkap</strong></label>
                                    <input type="text" name="name" class="form-control" value="{{ isset($data) ? $data->name : '' }}" readonly>
                                    @error('name')
                                        <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="email" class="form-label"><strong>Email</strong></label>
                                    <input type="email" name="email" class="form-control" value="{{ isset($data) ? $data->email : '' }}" readonly>
                                    @error('email')
                                        <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
                                    @enderror
                                </div>

                                <!-- No Rek -->
                                <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="no_rek" class="form-label"><strong>No Rekening</strong></label>
                                    <input type="number" name="no_rek" class="form-control" value="{{ isset($data) ? $data->no_rek : '' }}" readonly>
                                    @error('no_rek')
                                        <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
                                    @enderror
                                </div>

                                <!-- Nomor WhatsApp -->
                                <div class="form-group-cs col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="no_wa" class="form-label"><strong>Nomor Telepon</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text-cs">+62</span>
                                        </div>
                                        <input type="text" name="no_wa" id="no_wa" class="form-control" value="{{ isset($data) ? $data->no_wa : '' }}" placeholder="Masukkan No Telepon" readonly>
                                    </div>
                                    @error('no_wa')
                                        <p class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</p>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="form-group-cs col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="address" class="form-label"><strong>Alamat</strong></label>
                                    <textarea name="address" class="form-control ckeditor-custom-height" id="address" rows="5" readonly>{{ isset($data) ? $data->address : '' }}</textarea>
                                    @error('address')
                                        <div class="text-danger font-italic font-weight-bold mt-1" style="font-size: 12px;">{{$message}}!</div>
                                    @enderror
                                </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route($route.'index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
