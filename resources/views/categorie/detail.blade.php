@extends('layouts.dashboard.app')
@section('title', $title ?? 'Kategori')
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
                       
                        <!-- Name Input -->
                        <div class="form-group col-md-12 fv-row mb-3">
                            <label role="name" class="form-label fw-bolder text-dark fs-6">Nama</label>
                            <div class="position-relative mb-3">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                    autocomplete="off" value="{{ isset($data) ? $data->name : '' }}" placeholder="Input Name" readonly />
                                @error('name')
                                    <p style="font-size: 12px;" class="mb-0 text-danger mt-1 font-italic font-weight-bold">{{ $message }} !</p>
                                @enderror
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
