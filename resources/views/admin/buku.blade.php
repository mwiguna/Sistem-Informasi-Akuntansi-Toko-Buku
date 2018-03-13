@extends('layouts.template')
@section('content')

    <main class="col-12">
        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif
        
        <div class="col-10 content">
            <div class="col-12 title-content">Detail Buku</div>
            <form class="col-12 form-admin" method="post" action="/editBook"> 
                {{ csrf_field() }}
                <div class="col-12">Kode Buku :</div>
                <input name="kode" type="text" class="col-10 intext inmini" placeholder="Kode Buku" value="{{ $book->id }}" required>

                <div class="col-12">Judul Buku :</div>        
                <input name="judul" type="text" class="col-10 intext inmini" placeholder="Judul Buku" value="{{ $book->judul }}" required>   

                <div class="col-12">Penerbit :</div>    
                <input name="penerbit" type="text" class="col-10 intext inmini" placeholder="Penerbit" value="{{ $book->penerbit }}" required>

                <div class="col-12">Kategori :</div>    
                <select name="kategori" class="col-10 intext inmini">
                    <option value="Komputer"<?php if($book->kategori == "Komputer") echo "selected"; ?>>Komputer</option>
                    <option value="Sains" <?php if($book->kategori == "") echo "selected"; ?>>Sains</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Akuntansi">Akuntansi</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Ilmu Sosial">Ilmu Sosial</option>
                    <option value="Bahasa">Bahasa</option>
                    <option value="Teknik">Teknik</option>
                    <option value="Pertanian">Pertanian</option>
                    <option value="Peternakan">Peternakan</option>
                    <option value="Agama">Agama</option>
                </select>

                <div class="col-12">Harga :</div>      
                <input name="harga" type="number" min="0" class="col-10 intext inmini" placeholder="Harga" value="{{ $book->harga }}" required>

                <div class="col-12">Stok :</div>        
                <input name="stok" value="{{ $book->stok }}" type="number" class="col-10 intext inmini" placeholder="Stok" required>
                <input type="submit" class="col-2 insubmit inmini" value="Edit">
            </form>            
        </div>
    </main>

@endsection