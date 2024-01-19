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
<div>
    <table id="Model" class="table-hover whitespace-nowrap">
        <!-- Tabel untuk menampilkan data -->
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
            </tr>
        </thead>
    </table>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $.ajax({
        url: '/get-model',
        success: function(data) {
            $('#Model').DataTable({
                data: data,
                columns: [
                    { data: 'kode' },
                    { data: 'nama' },
                ],
                searching: true, // Aktifkan fitur pencarian
                lengthChange: false,
                pageLength: 5,
            });
        }
    })
</script>
@endsection
