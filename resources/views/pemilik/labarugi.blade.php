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
                	<div class="col-12 title-content center">Laporan Laba/Rugi</div>
            		<div class="col-12 tanggal">Per
                        {{ csrf_field() }} 
                        <select class="select-none" id="monthlr">
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
                        <select class="select-none" id="yearlr">
                            <?php $year = $date->format('Y') - 5; ?>
                            <?php for($i = 1; $i <= 5; $i++){ ?>
                                <option value="{{ $year+$i }}"<?php if($year+5 == $year+$i) echo "selected";?>>{{ $year+$i }}</option>
                            <?php } ?>
                        </select>
                    </div>
            	</div>
            	<div class="col-12">
            		<table class="col-10" border="0">
            			<tr><th style="width: 40%"><b>Pendapatan</b></th></tr>
            			<tr>
            				<td>Pendapatan Penjualan</td>
            				<td style="width: 35%"></td>
            				<td class="center" id="penjualan">Rp. {{ number_format($penjualan->total, 0, ',', '.') }},-</td>
            			</tr>
            			<tr><th><b>Beban</b></th></tr>
            			<tr>
            				<td>Pembelian Buku</td>
            				<td id="pembelian">Rp. {{ number_format($pembelian->total, 0, ',', '.') }},-</td>
            			</tr>
            			<tr>
                            <?php
                                $total = $penjualan->total - $pembelian->total;
                                $ket   = "Laba";
                                if($total < 0){
                                    $total = $total * -1;
                                    $ket   = "Rugi";        
                                }
                            ?>
            				<th><b id="ket">{{ $ket }}</b></th>
            				<td></td>
            				<td class="final" id="total">Rp. {{ number_format($total, 0, ',', '.') }},-</td>
            			</tr>
            		</table>
            	</div>
            </div>
            <button type="button" class="col-2 insubmit inmini" onclick="window.print()">Cetak</button>
        </div>
    </main>

@endsection