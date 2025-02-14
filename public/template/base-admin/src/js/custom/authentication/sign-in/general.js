"use strict";

// Definisi kelas
var KTSigninGeneral = function() {
    var form;
    var submitButton;
    var validator;

    var handleForm = function(e) {
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Alamat email wajib diisi'
                            },
                            emailAddress: {
                                message: 'Format alamat email tidak valid'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Kata sandi wajib diisi'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }
        );

        // Tangani pengiriman formulir
        submitButton.addEventListener('click', function (e) {
            // Cegah aksi default tombol
            e.preventDefault();

            // Validasi formulir
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Tampilkan indikasi pemuatan
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Nonaktifkan tombol untuk mencegah klik ganda
                    submitButton.disabled = true;

                    // Simulasikan permintaan ajax
                    setTimeout(function() {
                        // Sembunyikan indikasi pemuatan
                        submitButton.removeAttribute('data-kt-indicator');

                        // Aktifkan kembali tombol
                        submitButton.disabled = false;

                        // Tampilkan pesan popup. Untuk informasi lebih lanjut, periksa dokumentasi resmi plugin: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Anda berhasil masuk!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Oke, mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="email"]').value= "";
                                form.querySelector('[name="password"]').value= "";
                                //form.submit(); // kirim formulir
                            }
                        });
                    }, 2000);
                } else {
                    // Tampilkan pesan kesalahan. Untuk informasi lebih lanjut, periksa dokumentasi resmi plugin: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Oke, mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    }

    // Fungsi publik
    return {
        // Inisialisasi
        init: function() {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleForm();
        }
    };
}();

// Saat dokumen siap
KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});
