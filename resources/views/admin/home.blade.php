@extends('layouts.template')
@section('content')

    <main class="col-12">
        @include('layouts.admin')
        <div class="col-10 content">
            <div class="col-12 title-content">Tambah Penjualan</div>
            <form class="col-12 form-admin" onsubmit="return false" id="addBook"> 
                {{ csrf_field() }}
                <input id="kode" type="number" class="col-4 intext inmini" placeholder="Kode Buku" required>        
                <input id="jumlah" type="number" class="col-3 intext inmini" placeholder="Jumlah" required>
                <input type="submit" class="col-2 insubmit inmini" value="Tambah">
            </form>            
            <div class="col-12 pesanan"></div>
            <form id="submit" method="post" class="col-12" onsubmit="return false">
                {{ csrf_field() }}
                <input type="submit" class="col-2 insubmit inmini" value="Submit">
            </form>
        </div>
    </main>

@endsection
