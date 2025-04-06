@extends('layouts.dashboard.app')
@section('title', 'Dashboard')
@section('subtitle', 'Analitik Dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8 mb-5">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card card-xl-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 banner-admin-snack-box">
                            <h3 class="card-title fw-bolder text-white">Statistik Transaksi</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Chart-->
                            {{-- <div class="mixed-widget-2-chart card-rounded-bottom bg-" data-kt-color="primary"
                                style="height: 200px"></div> --}}
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6">Admin</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-admin">
                                                    {{ isset($datas['admin']) ? $datas['admin']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-3x svg-icon-primary d-block my-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Cart1.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                        height="24" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Cart1</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Transaksi</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-transaction">
                                                    {{ isset($datas['transaction']) ? $datas['transaction']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-3x svg-icon-primary d-block my-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Chart-line1.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                        height="24" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Chart-line1</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Jumlah Keuntungan
                                                </h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-profit">
                                                    @php
                                                        $totalPrize = collect($datas['transaction'])->sum(
                                                            'total_price',
                                                        );
                                                    @endphp
                                                    {{ isset($datas['transaction']) ? 'Rp ' . number_format($totalPrize, 2, ',', '.') : 'Rp 0,00' }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <div class="row g-5 g-xl-8">
                <div class="col-xl-12">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Total Order</span>
                                <span class="text-muted fw-bold fs-7">Grafik Total Order Tahun, Bulan, Mingguan</span>
                            </h3>
                            <div class="card-toolbar" data-kt-buttons="true">
                                <a class="btn btn-sm btn-color-muted btn-active btn-active-primary active px-4 me-1"
                                    id="kt_charts_widget_3_year_btn">Tahun</a>
                                <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4 me-1"
                                    id="kt_charts_widget_3_month_btn">Bulan</a>
                                <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4"
                                    id="kt_charts_widget_3_week_btn">Mingguan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="kt_widget_data" style="height: 350px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var KTWidgets = {
            init: function() {
                fetchDataAndRenderChart('year');

                document.getElementById('kt_charts_widget_3_year_btn').addEventListener('click', function() {
                    fetchDataAndRenderChart('year');
                });

                document.getElementById('kt_charts_widget_3_month_btn').addEventListener('click', function() {
                    fetchDataAndRenderChart('month');
                });

                document.getElementById('kt_charts_widget_3_week_btn').addEventListener('click', function() {
                    fetchDataAndRenderChart('week');
                });
            }
        };

        function fetchDataAndRenderChart(range) {
            const chartContainer = document.querySelector('#kt_widget_data');
            chartContainer.innerHTML = "";
            fetch(`/orders/orders/api/order-stats?range=${range}`)
                .then(response => response.json())
                .then(response => {
                    const colors = {
                        gray500: KTUtil.getCssVariableValue("--bs-gray-500"),
                        gray200: KTUtil.getCssVariableValue("--bs-gray-200"),
                        info: KTUtil.getCssVariableValue("--bs-info"),
                        lightInfo: KTUtil.getCssVariableValue("--bs-light-info")
                    };
                    const options = {
                        series: [{
                            name: "Total Order",
                            data: response.data.map(d => parseInt(d)),
                        }],
                        chart: {
                            fontFamily: "Poppins",
                            type: "area",
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            type: "solid",
                            opacity: 1
                        },
                        stroke: {
                            curve: "smooth",
                            show: true,
                            width: 3,
                            colors: [colors.info],
                        },
                        xaxis: {
                            categories: response.labels,
                            labels: {
                                style: {
                                    colors: colors.gray500,
                                    fontSize: "12px"
                                }
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                position: "front",
                                stroke: {
                                    color: colors.info,
                                    width: 1,
                                    dashArray: 3
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: colors.gray500,
                                    fontSize: "12px"
                                }
                            }
                        },
                        colors: [colors.lightInfo],
                        grid: {
                            borderColor: colors.gray200,
                            strokeDashArray: 4,
                            yaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        markers: {
                            strokeColor: colors.info,
                            strokeWidth: 3
                        }
                    };

                    new ApexCharts(chartContainer, options).render();
                })
                .catch(err => {
                    console.error("Failed to load data:", err);
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            KTWidgets.init();
        });
    </script>

@endsection
