@extends('layouts.master')
@section('menu')
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="/" class="text-primary hover:underline">Menu</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Master Data Merk</span>
        </li>
    </ul>
@endsection
@section('content')
    <!-- vertically centered -->
    <div class="mb-5" x-data="modal">
        <!-- button -->
        <div class="flex items-center justify-left">
            <button type="button" class="btn btn-info" @click="toggle">Tambah</button>
        </div>

        <!-- modal -->
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
            <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300
                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                        <h5 class="font-bold text-lg">Modal Title</h5>
                    </div>
                    <div class="p-5">
                        <form class="space-y-5" action="/">
                            <div class="grid grid-cols-1">
                                <div class="md:col-span-2">
                                    <label for="merk">Kode</label>
                                    <input id="merk" type="text" placeholder="Merk Mobil" class="form-input" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1">
                                <div class="md:col-span-2">
                                    <label for="model">Nama</label>
                                    <input id="model" type="text" placeholder="Model Mobil" class="form-input" />
                                </div>
                            </div>

                            <div class="flex justify-end items-center mt-8">
                                <button type="button" class="btn btn-outline-danger" @click="toggle">Close</button>
                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                    @click="toggle">Save</button>
                            </div>
                        </form>
                    </div>
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
            <table id="Merk" class="table-hover whitespace-nowrap">
                <!-- Tabel untuk menampilkan data -->
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        // $.ajax({
        //     url: '/get-merk',
        //     success: function(data) {
        //         $('#Merk').DataTable({
        //             data: data,
        //             columns: [
        //                 { data: 'kode' },
        //                 { data: 'nama' },
        //             ],
        //             searching: true, // Aktifkan fitur pencarian
        //             lengthChange: false,
        //             pageLength: 5,
        //         });
        //     }
        // })

        var table = $('#Merk').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('merk') }}",
                data: function(d) {
                    d.status = $('#status').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            pageLength: 5,
            searching: true
        });
    </script>
@endsection
