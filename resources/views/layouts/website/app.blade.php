<!doctype html>
<html lang="en">
  <head>
	{{--  open head  --}}
		@include('layouts.website.head')
	{{--  close head  --}}
  </head>
  <body>
    @include('sweetalert::alert')

	{{--  open banner  --}}
		@include('layouts.website.navbar')
	{{--  close banner  --}}

	<section class="section-pink" id="section-pink">

	{{--  open content  --}}
		@yield('content')
	{{--  close content  --}}

	{{--  open Footer  --}}
		@include('layouts.website.footer')
	{{--  closeFooter  --}}
    </section>

	<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Izin Lokasi Diperlukan</h5>
                </div>
                <div class="modal-body">
                    <p class="text-dark fw-medium">
						Aplikasi ini memerlukan akses lokasi Anda untuk dapat digunakan. Harap aktifkan izin lokasi pada pengaturan browser Anda:
					</p>
                    <ol>
                        <li>Klik ikon gembok di sebelah kiri URL.</li>
                        <li>Pilih "Site Settings" atau "Pengaturan Situs".</li>
                        <li>Ubah "Location" menjadi "Allow".</li>
                        <li>Refresh halaman untuk melanjutkan.</li>
                    </ol>
                    <p class="text-success mb-1">Ikuti langkah-langkah di atas untuk mengaktifkan izin lokasi.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success w-100" onclick="requestLocationPermission()">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

	@include('layouts.website.script')

	@yield('script')
  </body>
</html>
