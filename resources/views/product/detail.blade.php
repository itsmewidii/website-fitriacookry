@extends('layouts.dashboard.app')
@section('title', $title ?? 'Detail Product')
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
                                @if($data->image)
                                <img src="{{ $data->image }}" class="img-fluid" alt="" id="image-review">
                                @else
                                <img src="{{ asset('asset_admin/assets/image/example/example.jpg') }}" id="image-review" class="img-fluid" alt="">
                                @endif
                            </div>
                      </div>
                    </div>
    
                    <div class="col-lg-8">
                        <div class="card-body">
                            <div class="row">
                                <!-- Category Selection -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="category" class="form-label fw-bolder text-dark fs-6">Kategori</label>
                                    <div class="position-relative mb-3">
                                        <select name="category_id" class="form-control form-control-lg form-control-solid" disabled>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if(isset($data) && $category->id == $data->category_id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Name Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
                                    <div class="position-relative mb-3">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->name : '' }}"" placeholder="Input Name" readonly />
                                        @error('name')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Price Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="price" class="form-label fw-bolder text-dark fs-6">Harga</label>
                                    <div class="position-relative mb-3">
                                        <input type="number" name="price" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->price : '' }}" placeholder="Input Price" readonly />
                                        @error('price')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Quantity Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="qty" class="form-label fw-bolder text-dark fs-6">Jumlah</label>
                                    <div class="position-relative mb-3">
                                        <input type="number" name="qty" class="form-control form-control-lg form-control-solid"
                                            autocomplete="off" value="{{ isset($data) ? $data->qty : '' }}" placeholder="Input Quantity" readonly />
                                        @error('qty')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Status Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="status" class="form-label fw-bolder text-dark fs-6">Status</label>
                                    <div class="position-relative mb-3">
                                        <select name="status" class="form-control form-control-lg form-control-solid" disabled>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="non-active" {{ old('status') == 'non-active' ? 'selected' : '' }}>Non-active</option>
                                        </select>
                                        @error('status')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Description Input -->
                                <div class="form-group col-md-12 fv-row mb-3">
                                    <label role="description" class="form-label fw-bolder text-dark fs-6">Keterangan</label>
                                    <div class="position-relative mb-3">
                                        <textarea name="description" class="form-control form-control-lg form-control-solid mb-3" rows="4" readonly placeholder="Input Description">{{ isset($data) ? $data->description : '' }}</textarea>
                                        @error('description')
                                            <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                        @enderror
                                    </div>
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
