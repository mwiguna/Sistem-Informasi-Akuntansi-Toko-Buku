@extends('layouts.template')
@section('content')

    <main class="col-12">
        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif
        
        <div class="col-10 content">
            <div class="col-12 title-content">Tambah Pembelian</div>
            <form class="col-12 form-admin" onsubmit="return false" id="addBeli"> 
                {{ csrf_field() }}
                <input id="nama" type="text" class="col-5 col-lg-8 intext inmini" placeholder="Nama Barang" required>        
                <input id="jumlah" type="number" min="1" class="col-5 col-lg-8 intext inmini" placeholder="Jumlah" required>  
                <input id="harga" type="number" min="0" class="col-5 col-lg-8 intext inmini" placeholder="Harga" required>        
                <input id="supplier" type="text" class="col-5 col-lg-8 intext inmini" placeholder="Supplier" required>
                <input type="submit" class="col-2 insubmit inmini" value="Tambah">
            </form>            
            <div class="col-12 pesanan"></div>
            <form id="pembelian" method="post" class="col-12" onsubmit="return false">
                {{ csrf_field() }}
                <input type="submit" class="col-2 insubmit inmini" value="Submit">
            </form>
        </div>
    </main>

@endsection
