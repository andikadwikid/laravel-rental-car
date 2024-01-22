@extends('layouts.master')
@section('menu')
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="/" class="text-primary hover:underline">Menu</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Master Data Model</span>
        </li>
    </ul>
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-form" id="history-button">
        History
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">History Pengembalian Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="History" class="table">
                            <!-- Tabel untuk menampilkan data -->
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Model</th>
                                    <th>Tarif</th>
                                    <th>User</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Tanggal Kembali</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>
    <div>
        <div class="panel mt-6">
            <table id="Pinjam" class="table">
                <!-- Tabel untuk menampilkan data -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Tarif</th>
                        <th>User</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/flatpickr.js"></script>

    <script>
        const table = $('#Pinjam').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('retur-mobil') }}",
                data: function(d) {
                    d.status = $('#status').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'merk',
                    name: 'merk'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'tarif',
                    name: 'tarif'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'tgl_mulai',
                    name: 'tgl_mulai'
                },
                {
                    data: 'tgl_selesai',
                    name: 'tgl_selesai'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            pageLength: 10,
            searching: true
        });

        const history = $('#History').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('retur-mobil-history') }}",
                data: function(d) {
                    d.status = $('#status').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'merk',
                    name: 'merk'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'tarif',
                    name: 'tarif'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'tgl_mulai',
                    name: 'tgl_mulai'
                },
                {
                    data: 'tgl_selesai',
                    name: 'tgl_selesai'
                },
                {
                    data: 'tgl_kembali',
                    name: 'tgl_kembali'
                },
            ],
            pageLength: 10,
            searching: true
        });

        $('#history-button').on('click', function() {
            history.ajax.reload();
        })

        $('body').on('click', '.update', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id)
            Swal.fire({
                title: "Apakah Yakin Ingin Mengembalikan Mobil ?",
                showDenyButton: true,
                confirmButtonText: "Batal",
                denyButtonText: `Close`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        url: "/retur-mobil/" + id,
                        success: function(data) {

                            if (data.success) {
                                Swal.fire(data.success, "", "success")
                                    .then(() => {
                                        $('#form-pinjam').trigger("reset");
                                        $('.btn-close').click();
                                    });
                            }

                            if (data.error) {
                                Swal.fire(data.error, "", "error")
                                    .then(() => {
                                        $('#form-pinjam').trigger("reset");
                                        $('.btn-close').click();
                                    });
                            }
                            table.ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire("Batal", "", "info");
                }
            });
        });


        document.addEventListener("alpine:init", () => {
            let currentDate = new Date();
            let formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + "-" + currentDate
                .getDate();
            let date = formattedDate.toString();
            Alpine.data("form", () => ({
                date1: date,
                init() {
                    flatpickr(document.getElementById('tgl_mulai'), {
                            dateFormat: 'Y-m-d',
                            defaultDate: this.date1,
                        }),
                        flatpickr(document.getElementById('tgl_selesai'), {
                            dateFormat: 'Y-m-d',
                            defaultDate: this.date1,
                        })
                }
            }));
        });
    </script>
@endsection
