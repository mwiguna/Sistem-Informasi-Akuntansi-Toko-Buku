@extends('layouts.template')
@section('content')

    <main class="col-12">
        @include('layouts.gudang')
        <div class="col-10 content">
            <div class="col-12 title-content">Tambah Buku</div>
            <div class="col-12">{{ Session::get('msg') }}</div>
            <form class="col-12 form-admin" method="post" action="/addBook"> 
                {{ csrf_field() }}
                <div class="col-12">Kode Buku :</div>
                <input name="kode" type="number" class="col-10 intext inmini" placeholder="Kode Buku" value="{{ $id }}" required>

                <div class="col-12">Judul Buku :</div>        
                <input name="judul" type="text" class="col-10 intext inmini" placeholder="Judul Buku" required>

                <div class="col-12">Penerbit :</div>    
                <input name="penerbit" type="text" class="col-10 intext inmini" placeholder="Penerbit" required>

                <div class="col-12">Kategori :</div>    
                <select name="kategori" class="col-10 intext inmini">
                    <option value="Komputer">Komputer</option>
                    <option value="Sains">Sains</option>
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
                <input name="harga" type="number" min="0" class="col-10 intext inmini" placeholder="Harga" required>

                <div class="col-12">Stok :</div>        
                <input name="stok" type="number" class="col-10 intext inmini" placeholder="Stok" required>
                <input type="submit" class="col-2 insubmit inmini" value="Tambah">
            </form>            
        </div>
    </main>

@endsection