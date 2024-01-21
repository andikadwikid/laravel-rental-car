@extends('layouts.master')
@section('menu')
<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="/" class="text-primary hover:underline">Menu</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span>Info Data Mobil</span>
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form" id="add-data">
    Tambah
</button>
<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-mobil">
                    {{-- @method('POST') --}}
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="grid grid-cols-1">
                        <div class="md:col-span-2">
                            <label for="merk">Merk</label>
                            <select class="form-select" id="merk" name="merk">
                                <option selected>Choose...</option>
                                @foreach($merks as $merk)
                                <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="md:col-span-1">
                            <label for="model">Model</label>
                            {{-- <input id="model" type="text" placeholder="Model Mobil" name="model"
                                class="form-input" /> --}}
                            <select class="form-select" id="model" name="model">
                                <option selected>Choose...</option>
                                @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="md:col-span-2">
                            <label for="no_plat">Nomor Plat</label>
                            <input id="no_plat" type="text" placeholder="Nomor Plat Mobil" name="no_plat"
                                class="form-input" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <div class="md:col-span-2">
                            <label for="tarif">Tarif</label>
                            <input id="tarif" type="text" placeholder="Tarif Sewa Mobil" name="tarif"
                                class="form-input" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-button" value="Save">Save</button>
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
        <table id="Mobil" class="table-hover whitespace-nowrap">
            <!-- Tabel untuk menampilkan data -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Nomor Plat</th>
                    <th>Tarif</th>
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
    const table = $('#Mobil').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('info-data-mobil') }}",
                data: function(d) {
                    d.status = $('#status').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {
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
                    data: 'no_plat',
                    name: 'no_plat'
                },
                {
                    data: 'tarif',
                    name: 'tarif'
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

        //Add Data
        $('#add-data').click(function() {
            $('#title-modal').html("Tambah Data Mobil");
            $('#save-button').text("Save");
            $('#save-button').val("Save");
            $('#id').val('');
            $('#form-mobil').trigger("reset");
        });

        //Edit Data
        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            console.log(id)
            $.get("/get-data-mobil" + '/' + id , function(data) {
                $('#title-modal').html("Edit Data Mobil");
                $('#save-button').text("Update");
                $('#save-button').val("Update");
                $('#modal-form').modal('show');
                $('#id').val(data.id);
                $('#merk').val(data.merk);
                $('#model').val(data.model);
                $('#no_plat').val(data.no_plat);
                $('#tarif').val(data.tarif);

            })
        });

        //Save Data
        $('#save-button').click(function(e) {
            var id = $(this).data('id');
            let url
            let type
            if($('#save-button').val() == "Save"){
                url = "{{ route('info-data-mobil.store') }}";
                type = "POST";
            }else{
                url = "/info-data-mobil/"+id;
                type = "PUT";
            }
                e.preventDefault();
                $.ajax({
                    data: $('#form-mobil').serialize(),
                    url: url,
                    type: type,
                    dataType: 'json',
                    success: function(data) {
                        if(data.success)
                        {
                            SweetAlert.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.success
                            }).then(() => {

                            $('#form-mobil').trigger("reset");
                            $('.btn-close').click();
                            })
                        }
                        table.draw();
                    },
                    error: function(data) {
                        SweetAlert.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                        table.draw();
                    }
                });
            });

            //Hapus Data
            $('body').on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id)
                Swal.fire({
                    title: "Apakah Yakin Ingin Menghapus?",
                    showDenyButton: true,
                    confirmButtonText: "Hapus",
                    denyButtonText: `Batal`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "DELETE",
                                data: $('#form-mobil').serialize(),
                                url: "/info-data-mobil/" + id,
                                success: function(data) {

                                    if(data.success)
                                    {
                                        Swal.fire("Data Berhasil Dihapus !", "", "success")
                                        .then(() => {
                                            $('#form-mobil').trigger("reset");
                                            $('.btn-close').click();
                                        });
                                    }
                                table.draw();
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                }
                            });
                        } else if (result.isDenied) {
                        Swal.fire("Batal Menghapus", "", "info");
                        }
                    });

            });

</script>
@endsection