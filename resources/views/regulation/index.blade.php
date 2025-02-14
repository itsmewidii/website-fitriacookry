@extends('layouts.dashboard.app')
@section('title', $title ?? 'Peraturan')
@section('subtitle' , $subtitle ?? 'Peraturan')
@section('head')
@endsection

@section('script')
@include('categorie.datatable.script')
@endsection

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-fluid">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6" style="min-height: 30px;">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    {{--  <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari" />
                    </div>  --}}
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        </span>
                        <!--end::Export-->
                        {{--  <!--begin::Add user-->
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                </svg>
                            </span>
                            Add {{$title ?? 'Category'}}</a>
                        <!--end::Svg Icon-->
                        <!--end::Add user-->  --}}
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12"  id="kt_table_regulation">
                <div class="card">
                    <div class="card-header" style="min-height: 50px;">
                        <h4>Form {{ $title }}</h4>
                    </div>
                    <form method="POST" action="{{ route($route.'update', ['id' => $data->first()->id]) }}" class="needs-validation" enctype="multipart/form-data" id="xss-validation">
                        @csrf
                        @include($view.'field')
                        @method('PUT')
                    </form>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            {{--  <div class="card-body py-4">
            </div>  --}}
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection
