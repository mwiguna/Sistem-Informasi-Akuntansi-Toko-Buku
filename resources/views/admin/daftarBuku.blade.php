@extends('layouts.template')
@section('content')

    <main class="col-12">

        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif

        <div class="col-10 content">
            <div class="col-12 title-content">Daftar Buku</div>
                
                <div class="col-12">{{ Session::get('msg') }}</div>
                <input id="judul" type="text" class="col-4 intext inmini" placeholder="Cari Buku" required>
                <button type="button" id="btn-cari" class="col-2 insubmit inmini">Cari</button>
                <table bordercolor="#aaa" class="col-11 col-lg-9 col-md-7 col-sm-5 col-xs-3 tmargin" border="1px">
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 10%">Kode Buku</th>
                        <th style="width: 30%">Judul</th>
                        <th style="width: 15%">Penerbit</th>
                        <th style="width: 15%">Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                    <?php $i = (!isset($_GET['page']) || $_GET['page'] == 1) ? 1 : $_GET['page'] * 8 - 7 ; ?>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $i }}.</td>
                        <td><a href="/buku/{{ $book->id }}">{{ $book->id }}</a></td>
                        <td>{{ $book->judul }}</td>
                        <td><a href="/buku/penerbit/{{ $book->penerbit }}">{{ $book->penerbit }}</a></td>
                        <td><a href="/buku/kategori/{{ $book->kategori }}">{{ $book->kategori }}</a></td>
                        <td>Rp. {{ number_format($book->harga, 0, ',', '.') }}</td>
                        <td>{{ $book->stok }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </table>

                <div class="col-12">{{ $books->links() }}</div>
                <a href="/cetak/daftarBuku" class="col-2 insubmit inmini center">Cetak</a>
        </div>
    </main>

@endsection