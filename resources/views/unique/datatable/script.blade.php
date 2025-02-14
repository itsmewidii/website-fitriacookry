<script>
    "use strict";

    var KTUsersList = function() {
        var table = $('#kt_table_unique');
        var datatable;
        var toolbarBase;
        var toolbarSelected;
        var selectedCount;

        var initUserTable = function() {
            datatable = table.DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "/uniques",
                    "type": "GET",
                    "dataSrc": function(json) {
                        return json.data;
                    }
                },
                'columnDefs': [{
                        orderable: false,
                        targets: 0
                    },
                    {
                        orderable: false,
                        targets: 6
                    },
                ],
                'columns': [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false
                    },
                    {
                        data: 'code' ?? '-'
                    },
                    {
                        data: 'info',
                        render: function(data, type, row) {
                            try {
                                console.log("Raw Data:", data);
                                const decodedData = decodeEntities(data);
                                if (typeof decodedData !== 'string' || decodedData.trim()
                                    .charAt(0) !== '{') {
                                    return `<span class="badge bg-secondary">${decodedData || '-'}</span>`;
                                }
                                const jsonData = JSON.parse(decodedData);

                                return `
                <div class="d-flex flex-wrap gap-1">
                    <span class="badge bg-primary">🖥 Platform: ${jsonData.platform || '-'}</span>
                    <span class="badge bg-success">🌐 Browser: ${jsonData.browser || '-'}</span>
                    <span class="badge bg-warning">💻 OS: ${jsonData.os || '-'}</span>
                    <span class="badge bg-info">🗣 Bahasa: ${jsonData.language || '-'}</span>
                    <span class="badge bg-dark">📱 Mobile: ${jsonData.isMobile ? 'Ya ✅' : 'Tidak ❌'}</span>
                    <span class="badge bg-danger">🖥 Desktop: ${jsonData.isDesktop ? 'Ya ✅' : 'Tidak ❌'}</span>
                </div>
            `;
                            } catch (e) {
                                console.error("JSON Parse Error:", e.message, "Data:", data);
                                return '<span class="badge bg-danger">Data tidak valid</span>';
                            }
                        }
                    },

                    {
                        data: 'lat' ?? '-'
                    },
                    {
                        data: 'long' ?? '-'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            const date = new Date(data);
                            const formattedDate = date.toLocaleString('id-ID', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                }).replace(/\./g, '') +
                                ' | ' +
                                date.toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });
                            return formattedDate;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex justify-content-between">
                                    <a href="https://www.google.com/maps?q=${row.lat},${row.long}" target="_blank" class="btn btn-sm btn-warning p-3 m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M18.0624 15.3454L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3454C4.56242 13.6454 3.76242 11.4452 4.06242 8.94525C4.56242 5.34525 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24525 19.9624 9.94525C20.0624 12.0452 19.2624 13.9454 18.0624 15.3454ZM13.0624 10.0453C13.0624 9.44534 12.6624 9.04534 12.0624 9.04534C11.4624 9.04534 11.0624 9.44534 11.0624 10.0453V13.0453H13.0624V10.0453Z" fill="black"/>
                                            <path d="M12.6624 5.54531C12.2624 5.24531 11.7624 5.24531 11.4624 5.54531L8.06241 8.04531V12.0453C8.06241 12.6453 8.46241 13.0453 9.06241 13.0453H11.0624V10.0453C11.0624 9.44531 11.4624 9.04531 12.0624 9.04531C12.6624 9.04531 13.0624 9.44531 13.0624 10.0453V13.0453H15.0624C15.6624 13.0453 16.0624 12.6453 16.0624 12.0453V8.04531L12.6624 5.54531Z" fill="white"/>
                                        </svg>
                                    </a>`;
                        },
                        orderable: false
                    }
                ]
            });

            var initToggleToolbar = function() {
                console.log('Toolbar initialized');
            }

            var handleDeleteRows = function() {
                table.on('click', '.btn-delete', function() {
                    var userId = $(this).data('id');
                    var row = $(this).closest('tr');
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    Swal.fire({
                        text: "Are you sure you want to delete this product?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/uniques/delete/${userId}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            datatable.row(row).remove()
                                                .draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        text: "Failed to delete the user.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            }

            var decodeEntities= function(encodedString) {
                let textArea = document.createElement('textarea');
                textArea.innerHTML = encodedString;
                return textArea.value;
            }

            var toggleToolbars = function() {
                console.log('Toggle toolbars');
            }

            datatable.on('draw', function() {
                initToggleToolbar();
                handleDeleteRows();
                toggleToolbars();
            });
        }

        var handleSearchDatatable = function() {
            const filterSearch = $('[data-kt-user-table-filter="search"]');
            filterSearch.on('keyup', function() {
                datatable.search(this.value).draw();
            });
        }

        return {
            init: function() {
                initUserTable();
                handleSearchDatatable();
            }
        }
    }();

    $(document).ready(function() {
        KTUsersList.init();
    });
</script>
