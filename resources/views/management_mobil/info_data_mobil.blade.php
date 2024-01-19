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
<div class="panel">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light">Entry Data Mobil</h5>

    </div>
    <div class="mb-5">
        <form class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="merk">Merk</label>
                    <input id="merk" type="text" placeholder="Merk Mobil" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="model">Model</label>
                    <input id="model" type="text" placeholder="Model Mobil" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="no_plat">Nomor Plat Mobil</label>
                    <input id="no_plat" type="text" placeholder="Nomor Plat Mobil" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="tarif">Tarif Sewa</label>
                    <input id="tarif" type="text" placeholder="Tarif Sewa" class="form-input" />
                </div>
            </div>
            <button type=" submit" class="btn btn-primary !mt-6">Submit</button>
        </form>
    </div>

</div>
@endsection
