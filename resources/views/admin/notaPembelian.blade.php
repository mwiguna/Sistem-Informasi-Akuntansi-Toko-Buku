@extends('layouts.template')
@section('content')

    <main class="col-12">
        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif
        <div class="col-10 content">
            <div class="col-12 nota">
                <div class="col-12 title-content title-nota">Nota Pembelian</div>
                <table class="col-8" border="0">
                    <tr>
                        <td class="left" style="width: 20%">No. Faktur</td>
                        <td style="width: 1%">:</td>
                        <td class="left" style="width: 75%">#{{ $notas[0]->faktur_id }}</td>
                    </tr>
                    <tr>
                        <td class="left">Tanggal</td>
                        <td>:</td>
                        <td class="left">{{ $controller->tanggal($notas[0]->created_at) }}</td>
                    </tr>
                </table>
                <table bordercolor="#aaa" class="col-11 col-lg-9 col-md-7 col-sm-5 col-xs-3 tmargin" border="1px">
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 15%">Nama Barang</th>
                        <th>Harga</th>
                        <th style="width: 5%">Jumlah</th>
                        <th>Supplier</th>
                        <th>Total</th>
                    </tr>
                    <?php $i = 1; $total = 0; ?>
                    @foreach($notas as $nota)
                    <tr>
                        <td>{{ $i }}.</td>
                        <td>{{ $nota->nama }}</td>
                        <td>Rp. {{ number_format($nota->harga, 0, ',', '.') }}</td>
                        <td>{{ $nota->jumlah }}</td>
                        <td>{{ $nota->supplier }}</td>
                        <td>Rp. {{ number_format($nota->harga * $nota->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    <?php
                        $i++;
                        $total += $nota->harga * $nota->jumlah;
                    ?>
                    @endforeach
                    <tr>
                        <td colspan="5">Subtotal</td>
                        <td><b>Rp. {{ number_format($total, 0, ',', '.') }}</b></td>
                    </tr>
                    
                </table>
            </div>
            <button type="button" class="col-2 insubmit inmini" onclick="window.print()">Cetak</button>

            <a href="/pembelian" class="col-2 insubmit inmini btn-green">Tambah Baru</a>
            <a href="/daftar/pembelian" class="col-2 insubmit inmini btn-green">Daftar</a>
            <a href="/deletePembelian/{{ $notas[0]->faktur_id }}" class="col-2 insubmit inmini btn-green" onclick="return confirm('Yakin ini menghapus pembelian ini?')">Hapus</a>
        </div>
    </main>

@endsection
