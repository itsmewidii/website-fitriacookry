@extends('layouts.dashboard.app')
@section('title', $title ?? 'Pengakses')
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
                <div class="card-body">
                    <div class="row">
                       
                        <!-- Code Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label role="code" class="form-label fw-bolder text-dark fs-6">Kode</label>
                            <div class="position-relative mb-3">
                                <input type="text" name="code" class="form-control form-control-lg form-control-solid"
                                    autocomplete="off" value="{{ isset($data) ? $data->code : '' }}" readonly placeholder="Input code" />
                                @error('code')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Info Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label for="info" class="form-label fw-bolder text-dark fs-6">Informasi</label>
                            <input type="text" name="info" id="info" class="form-control form-control-lg form-control-solid"
                                autocomplete="off" value="{{ old('info', isset($data) ? $data->info : '') }}" readonly placeholder="Input info" />
                            @error('info')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                            @enderror
                        </div>
                
                        <!-- Lat Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label for="lat" class="form-label fw-bolder text-dark fs-6">Lintang</label>
                            <input type="text" name="lat" id="lat" class="form-control form-control-lg form-control-solid"
                                autocomplete="off" value="{{ old('lat', isset($data) ? $data->lat : '') }}" readonly placeholder="Input latitude" />
                            @error('lat')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                            @enderror
                        </div>
                
                        <!-- Long Input -->
                        <div class="form-group col-md-6 fv-row mb-3">
                            <label for="long" class="form-label fw-bolder text-dark fs-6">Garis bujur</label>
                            <input type="text" name="long" id="long" class="form-control form-control-lg form-control-solid"
                                autocomplete="off" value="{{ old('long', isset($data) ? $data->long : '') }}" readonly placeholder="Input longitude" />
                            @error('long')
                                <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                            @enderror
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
