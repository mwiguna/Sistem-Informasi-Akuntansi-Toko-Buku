@extends('layouts.template')
@section('content')

    <main class="col-12">
        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif
        <div class="col-10 content">
            <div class="col-12 nota labarugi">
                <div class="col-12 kop">
                    <div class="col-12 title-content center">Laporan Pembelian</div>
                    <div class="col-12 tanggal">Per
                        {{ csrf_field() }} 
                        <select class="select-none" id="monthpm">
                            <?php $month = $date->format('m'); ?>
                            <option value="0"></option>
                            <option value="1"<?php if($month == 1) echo "selected";?>>Januari</option>
                            <option value="2"<?php if($month == 2) echo "selected";?>>Februari</option>
                            <option value="3"<?php if($month == 3) echo "selected";?>>Maret</option>
                            <option value="4"<?php if($month == 4) echo "selected";?>>April</option>
                            <option value="5"<?php if($month == 5) echo "selected";?>>Mei</option>
                            <option value="6"<?php if($month == 6) echo "selected";?>>Juni</option>
                            <option value="7"<?php if($month == 7) echo "selected";?>>Juli</option>
                            <option value="8"<?php if($month == 8) echo "selected";?>>Agustus</option>
                            <option value="9"<?php if($month == 9) echo "selected";?>>September</option>
                            <option value="10"<?php if($month == 10) echo "selected";?>>Oktober</option>
                            <option value="11"<?php if($month == 11) echo "selected";?>>November</option>
                            <option value="12"<?php if($month == 12) echo "selected";?>>Desember</option>
                        </select>
                        <select class="select-none" id="yearpm">
                            <?php $year = $date->format('Y') - 5; ?>
                            <?php for($i = 1; $i <= 5; $i++){ ?>
                                <option value="{{ $year+$i }}"<?php if($year+5 == $year+$i) echo "selected";?>>{{ $year+$i }}</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <table class="col-11" border="0">
                        <tr><th style="width: 35%"><b>Pengeluaran</b></th></tr>
                        <tr>
                            <td>Total Barang</td>
                            <td id="barang">{{ $penjualan->jumlah }} Barang</td>
                        </tr>
                        <tr>
                            <td>Total Pengeluaran</td>
                            <td  id="pengeluaran">Rp. {{ number_format($penjualan->total, 0, ',', '.') }},-</td>
                        </tr><tr>
                            <td>Total Transaksi</td>
                            <td id="transaksi">{{ $transaksi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <button type="button" class="col-2 insubmit inmini" onclick="window.print()">Cetak</button>
        </div>
    </main>

@endsection