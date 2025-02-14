@extends('layouts.website.app')
@section('title', $meta_title ?? 'Keranjang')
@section('subtitle', $subtitle ?? 'Keranjang')
@section('head')
    <style>
        .btn-secondary {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .form-input-qty {
            width: 50px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5" style="margin-top: 150px">
                    <h1 class="fw-bold text-dark mb-3">Keranjang</h1>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-start fw-bold mb-0">Informasi Keranjang</h5>
                                    <div id="row-cart">
                                        <div class="mt-3 mb-3">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <h6 class="text-start">Total Harga</h6>
                                            <p class="mb-0">:</p>
                                            <p class="mb-0 text-success fw-bold" id="total-price-all" data-total="0">Rp 0
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-success w-100" data-bs-toggle="modal"
                                        data-bs-target="#modalCheckout" disabled id="checkout-condition">Checkout</button>
                                    <div class="modal fade" id="modalCheckout" tabindex="-1"
                                        aria-labelledby="modalCheckoutLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content p-1">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalCheckoutLabel">Checkout Order</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form id="checkoutForm">
                                                                <div class="mb-3">
                                                                    <label class="text-start mb-1 fw-bold"
                                                                        for="fullName">Nama
                                                                        Lengkap</label>
                                                                    <input type="text" class="form-control"
                                                                        name="fullName" id="fullName" required
                                                                        placeholder="Masukan Nama Lengkap"
                                                                        value="{{ auth('customer')->user()->name ?? '' }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="text-start mb-1 fw-bold" for="whatsapp">No
                                                                        Whatsapp</label>
                                                                    <input type="number" class="form-control"
                                                                        name="whatsapp" id="whatsapp" required
                                                                        placeholder="Masukan No Whatsapp"
                                                                        value="{{ auth('customer')->user()->phone ?? '' }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="text-start mb-1 fw-bold"
                                                                        for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        name="email" id="email" required
                                                                        placeholder="Masukan Email"
                                                                        value="{{ auth('customer')->user()->email ?? '' }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="text-start mb-1 fw-bold"
                                                                        for="address">Alamat</label>
                                                                    <textarea name="address" class="form-control form-control-lg form-control-solid" id="address" rows="4" required
                                                                        placeholder="Alamat"></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="text-start mb-1 fw-bold"
                                                                        for="paymentProof">Bukti
                                                                        Transfer</label>
                                                                    <input type="file" class="form-control"
                                                                        name="paymentProof" id="paymentProof"
                                                                        accept=".jpg,.jpeg,.png,.pdf" required>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <p class="text-start text-black mb-0"
                                                                    style="font-size: 14px; font-weight: 400">Berikut adalah
                                                                    data yang harus Anda lengkapi untuk proses checkout:
                                                                    <br> 1.
                                                                    <span class="fw-bold text-black">Nama Lengkap</span> -
                                                                    Masukkan nama lengkap Anda. <br> 2. <span
                                                                        class="fw-bold text-black">Nomor WhatsApp</span> -
                                                                    Pastikan nomor WhatsApp Anda yang aktif agar bisa
                                                                    dihubungi.
                                                                    <br> 3. <span class="fw-bold text-black">Email</span> -
                                                                    Masukkan alamat email yang valid untuk konfirmasi. <br>
                                                                    4.
                                                                    <span class="fw-bold text-black">Alamat</span> - Tulis
                                                                    alamat yang lengkap untuk pengiriman atau keperluan
                                                                    lainnya.
                                                                    <br> 5. <span class="fw-bold text-black">Bukti
                                                                        Transfer</span> - Unggah file bukti pembayaran Anda.
                                                                </p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="text-start mb-2 text-dark"
                                                                    style="font-size: 14px; font-weight: 400">
                                                                    {{ isset($regulation) ? $regulation->description : '-' }}
                                                                </p>
                                                                <div class="bg-success p-2">
                                                                    <p class="text-start mb-0 text-white"
                                                                        style="font-size: 14px; font-weight: bold">
                                                                        {{ isset($regulation) ? $regulation->bank : '-' }}
                                                                    </p>
                                                                    <p class="text-start mb-0 text-white"
                                                                        style="font-size: 14px; font-weight: bold">
                                                                        {{ isset($regulation) ? $regulation->rek_name : '-' }}
                                                                    </p>
                                                                    <p class="text-start text-white mb-0"
                                                                        style="font-size: 14px; font-weight: bold">
                                                                        {{ isset($regulation) ? $regulation->rek_no : '-' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="text-dark fw-bold mb-0">Nominal Pembayaran
                                                                    Transfer</p>
                                                                <p class="text-success fw-bold" id="total-price-modal"
                                                                    style="font-size: 16px">Rp 0</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success w-100"
                                                        id="checkoutButton" disabled>Selesaikan Pembayaran !</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-start fw-bold mb-3 fs-5">Riwayat Order</h5>
                                    <div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-info">
                                                    <tr>
                                                        <th>No. Resi</th>
                                                        <th>Ekspedisi</th>
                                                        <th>Ongkir</th>
                                                        <th>Pembayaran</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const device_id = @json(auth('customer')->user()->id);
            const orderTableBody = document.querySelector("tbody");
            const trackingUrls = {
                "JNE": "https://www.jne.co.id/id/tracking/trace",
                "SiCepat": "https://www.sicepat.com/checkAwb",
                "J&T Express": "https://www.jet.co.id/track",
                "Anteraja": "https://anteraja.id/tracking",
                "Lion Parcel": "https://lionparcel.com/id/tracking",
                "SAP Express": "https://www.sap-express.id/layanan/tracking",
                "Paxel": "https://paxel.co/id/tracking",
                "Ninja Express": "https://www.ninjaxpress.co/id-id/tracking",
                "Gosend": "https://www.gojek.com/id-id/gosend/",
                "GrabExpress": "https://www.grab.com/id/express/",
                "Troben": "#", 
                "Fitria Cookry": "#",
            };

            fetch(`/order/get/${device_id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        orderTableBody.innerHTML = "";

                        data.data.forEach(order => {
                            let statusBadge = "";
                            switch (order.status) {
                                case "PENDING":
                                    statusBadge = '<span class="badge bg-secondary">PENDING</span>';
                                    break;
                                case "PROSES":
                                    statusBadge = '<span class="badge bg-warning">PROSES</span>';
                                    break;
                                case "DIKIRIM":
                                    statusBadge = '<span class="badge bg-primary">DIKIRIM</span>';
                                    break;
                                case "SELESAI":
                                    statusBadge = '<span class="badge bg-success">SELESAI</span>';
                                    break;
                                default:
                                    statusBadge = '<span class="badge bg-dark">UNKNOWN</span>';
                            }

                            let formattedPrice = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(order.total_price);

                            let formattedPriceShipping = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(order.shipping_price);

                            let orderDate = new Date(order.created_at).toLocaleDateString("id-ID");
                            let shippingLink = trackingUrls[order.shipping] ?
                                `<a href="${trackingUrls[order.shipping]}" target="_blank" class="text-primary">${order.shipping}</a>` :
                                order.shipping || "-";

                            orderTableBody.innerHTML += `
                        <tr>
                            <td class="copyable-resi resi-table" title="Copy ${order.shipping_code}" onclick="copyToClipboard(this)">${order.shipping_code || '-'}</td>
                            <td>${shippingLink}</td>
                            <td>${formattedPriceShipping}</td>
                            <td>${formattedPrice}</td>
                            <td>${statusBadge}</td>
                            <td style="white-space: nowrap;">${orderDate}</td>
                        </tr>
                    `;
                        });
                    } else {
                        orderTableBody.innerHTML =
                            `<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>`;
                    }
                })
                .catch(error => {
                    console.error("Error fetching orders:", error);
                    orderTableBody.innerHTML =
                        `<tr><td colspan="5" class="text-center">Terjadi kesalahan, coba lagi</td></tr>`;
                });
        });


        function copyToClipboard(element) {
            const text = element.textContent.trim();
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    title: "Disalin!",
                    text: `Nomor resi ${text} telah disalin ke clipboard.`,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(err => {
                console.error("Gagal menyalin:", err);
            });
        }

        const checkoutForm = document.getElementById("checkoutForm");
        const checkoutButton = document.getElementById("checkoutButton");
        const checkoutFirstCondition = document.getElementById("checkout-condition");
        var device_id = @json(auth('customer')->user()->id);

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function validateForm() {
            const inputs = checkoutForm.querySelectorAll("input, textarea");
            let isValid = true;
            inputs.forEach((input) => {
                if (!input.value.trim()) {
                    isValid = false;
                }
            });
            checkoutButton.disabled = !isValid;
        }
        checkoutForm.addEventListener("input", validateForm);

        checkoutButton.addEventListener("click", function(event) {
            event.preventDefault();

            const device_id = @json(auth('customer')->user()->id);
            const formData = new FormData(checkoutForm);

            fetch(`/checkout/order/${device_id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Checkout Berhasil!",
                            text: "Pesanan Anda telah diproses.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Terjadi Kesalahan!",
                            text: data.message || "Silakan coba lagi.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Terjadi Kesalahan!",
                        text: "Silakan coba lagi.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
        });


        function getCartData(unique) {
            fetch(`/cart/get/${unique}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderCartItems(data.data);
                        checkoutFirstCondition.disabled = false;
                    } else {
                        document.getElementById("row-cart").innerHTML =
                            `<p class="p-3 text-center mb-0">Keranjang Masih Kosong</p>`;
                        checkoutFirstCondition.disabled = true;
                    }
                })
                .catch(error => {
                    console.error("Error fetching cart data:", error);
                    document.getElementById("row-cart").innerHTML =
                        `<p class="p-3 text-center mb-0">Keranjang Masih Kosong</p>`;
                    checkoutFirstCondition.disabled = true;
                });
        }

        function renderCartItems(items) {
            const cartContainer = document.getElementById("row-cart");
            const totalPriceElement = document.getElementById("total-price-all");
            const totalPriceModalElement = document.getElementById('total-price-modal');

            if (!items || items.length === 0) {
                cartContainer.innerHTML = `<p class="p-3 text-center mb-0">Keranjang Masih Kosong</p>`;
                totalPriceElement.textContent = "Rp. 0";
                totalPriceModalElement.textContent = "Rp. 0";
                return;
            } else {
                let totalPrice = 0;
                const cartItemsHTML = items.map(item => {
                    totalPrice += item.total_price;
                    return `
                    <div class="mt-3 mb-3" id="cart-item-${item.id}">
                        <div class="card bg-green-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div>
                                            <img src="${item.product.image ?? '-'}" class="img-fluid"
                                                style="width: 50px; height: 50px; object-fit: cover; border: 1px solid black"
                                                alt="">
                                        </div>
                                        <div>
                                            <h6 class="text-start fw-bold mb-0">${item.product.name ?? '-'}</h6>
                                            <div class="d-flex justify-content-center gap-2">
                                                <p class="text-start mb-0" style="font-size: 14px; font-weight: 400">${item.product.categorie?.name ?? '-'}</p>
                                                <p class="text-start mb-0" style="font-size: 14px; font-weight: 400">Rp. ${formatRupiah(item.total_price)}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <input type="number" class="form-input-qty mx-2" name="cart_qty[]" id="cart_qty_${item.id}" value="${item.qty}" data-price="${item.product.price}" readonly>
                                            <button type="button" 
                                                class="btn btn-danger p-1"
                                                style="height: 30px; line-height: 15px; width: 30px; z-index: 10;"
                                                onclick="removeCart('${item.id}')"
                                                title="Hapus Cart">
                                                <svg width="12" height="14" viewBox="0 0 12 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_296_2)">
                                                            <path
                                                                d="M0.857143 12.4458C0.857143 12.7873 0.992602 13.1148 1.23372 13.3562C1.47484 13.5977 1.80186 13.7333 2.14286 13.7333H9.85714C10.1981 13.7333 10.5252 13.5977 10.7663 13.3562C11.0074 13.1148 11.1429 12.7873 11.1429 12.4458V3.43334H0.857143V12.4458ZM8.14286 5.57917C8.14286 5.46535 8.18801 5.35619 8.26838 5.2757C8.34876 5.19522 8.45776 5.15 8.57143 5.15C8.68509 5.15 8.7941 5.19522 8.87447 5.2757C8.95485 5.35619 9 5.46535 9 5.57917V11.5875C9 11.7013 8.95485 11.8105 8.87447 11.891C8.7941 11.9714 8.68509 12.0167 8.57143 12.0167C8.45776 12.0167 8.34876 11.9714 8.26838 11.891C8.18801 11.8105 8.14286 11.7013 8.14286 11.5875V5.57917ZM5.57143 5.57917C5.57143 5.46535 5.61658 5.35619 5.69695 5.2757C5.77733 5.19522 5.88634 5.15 6 5.15C6.11366 5.15 6.22267 5.19522 6.30305 5.2757C6.38342 5.35619 6.42857 5.46535 6.42857 5.57917V11.5875C6.42857 11.7013 6.38342 11.8105 6.30305 11.891C6.22267 11.9714 6.11366 12.0167 6 12.0167C5.88634 12.0167 5.77733 11.9714 5.69695 11.891C5.61658 11.8105 5.57143 11.7013 5.57143 11.5875V5.57917ZM3 5.57917C3 5.46535 3.04515 5.35619 3.12553 5.2757C3.2059 5.19522 3.31491 5.15 3.42857 5.15C3.54224 5.15 3.65124 5.19522 3.73162 5.2757C3.81199 5.35619 3.85714 5.46535 3.85714 5.57917V11.5875C3.85714 11.7013 3.81199 11.8105 3.73162 11.891C3.65124 11.9714 3.54224 12.0167 3.42857 12.0167C3.31491 12.0167 3.2059 11.9714 3.12553 11.891C3.04515 11.8105 3 11.7013 3 11.5875V5.57917ZM11.5714 0.858339H8.35714L8.10536 0.356751C8.05202 0.249516 7.96986 0.159313 7.86812 0.0962892C7.76638 0.0332649 7.6491 -7.98404e-05 7.52946 6.08119e-06H4.46786C4.34848 -0.000516707 4.23138 0.0326777 4.12999 0.0957792C4.0286 0.158881 3.94703 0.249332 3.89464 0.356751L3.64286 0.858339H0.428571C0.314907 0.858339 0.205898 0.903554 0.125526 0.984039C0.0451529 1.06452 0 1.17368 0 1.28751L0 2.14584C0 2.25966 0.0451529 2.36882 0.125526 2.4493C0.205898 2.52979 0.314907 2.575 0.428571 2.575H11.5714C11.6851 2.575 11.7941 2.52979 11.8745 2.4493C11.9548 2.36882 12 2.25966 12 2.14584V1.28751C12 1.17368 11.9548 1.06452 11.8745 0.984039C11.7941 0.903554 11.6851 0.858339 11.5714 0.858339Z"
                                                                fill="white" />
                                                        </g>
                                                    </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                }).join('');

                cartContainer.innerHTML = cartItemsHTML;
                totalPriceElement.textContent = `Rp. ${formatRupiah(totalPrice)}`;
                totalPriceModalElement.textContent = `Rp. ${formatRupiah(totalPrice)}`;
            }
        }

        // function updateQuantity(itemId, change) {
        //     const quantityInput = document.getElementById(`cart_qty_${itemId}`);
        //     const totalPriceElement = document.getElementById("total-price-all");
        //     const totalPriceModal = document.getElementById("total-price-modal");

        //     if (!quantityInput || !totalPriceElement || !totalPriceModal) return;

        //     let quantity = parseInt(quantityInput.value) || 0;
        //     quantity += change;

        //     if (quantity < 1) quantity = 1; // Minimal 1 produk
        //     quantityInput.value = quantity;

        //     // Ambil harga satuan dari atribut data-price
        //     const productPrice = parseInt(quantityInput.dataset.price) || 0;

        //     // Hitung ulang total harga berdasarkan semua item di keranjang
        //     let totalPrice = 0;
        //     document.querySelectorAll("[id^='cart_qty_']").forEach((input) => {
        //         const qty = parseInt(input.value) || 0;
        //         const price = parseInt(input.dataset.price) || 0;
        //         totalPrice += qty * price;
        //     });

        //     // Update tampilan total harga
        //     totalPriceElement.textContent = `Rp. ${formatRupiah(totalPrice)}`;
        //     totalPriceElement.dataset.total = totalPrice;

        //     totalPriceModal.textContent = `Rp. ${formatRupiah(totalPrice)}`;
        // }

        function updateQuantity(itemId, change) {
            const quantityInput = document.getElementById(`cart_qty_${itemId}`);
            const totalPriceElement = document.getElementById("total-price-all");
            if (!quantityInput || !totalPriceElement) return;
            let quantity = parseInt(quantityInput.value) || 0;
            quantity += change;
            if (quantity < 1) quantity = 1;
            quantityInput.value = quantity;
            const productPrice = parseInt(quantityInput.dataset.price) || 0;
            let totalPrice = parseInt(totalPriceElement.dataset.total) || 0;
            totalPrice += change * productPrice;
            if (totalPrice < productPrice) totalPrice = productPrice;
            totalPriceElement.textContent = `Rp. ${formatRupiah(totalPrice)}`;
            totalPriceElement.dataset.total = totalPrice;
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function removeCart(itemId) {
            fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const itemElement = document.getElementById(`cart-item-${itemId}`);
                        if (itemElement) {
                            itemElement.remove();
                        }

                        if (data.data) {
                            renderCartItems(data.data);
                            checkoutFirstCondition.disabled = false;
                        } else {
                            document.getElementById("row-cart").innerHTML =
                                `<p class="p-3 text-center mb-0">Keranjang Masih Kosong</p>`;
                            renderCartItems([]);
                            checkoutFirstCondition.disabled = true;
                        }
                        alert('Produk berhasil dihapus dari keranjang!');
                    } else {
                        alert('Gagal menghapus produk dari keranjang!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                });
        }

        getCartData(device_id);
    </script>
@endsection
