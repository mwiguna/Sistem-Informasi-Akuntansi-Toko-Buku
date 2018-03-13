@extends('layouts.template')
@section('content')

    <main class="col-12">
        @if(Auth::user()->name == "admin") @include('layouts.admin')
        @elseif(Auth::user()->name == "gudang") @include('layouts.gudang')
        @else @include('layouts.pemilik')
        @endif
        
        <div class="col-10 content">
            <div class="col-12 title-content">Daftar Penjualan</div>
                
                <div class="col-12 tanggal left">Per
                    <select class="select-none" id="monthpn">
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
                    <select class="select-none" id="yearpn">
                        <?php 
                            $yearNow = $date->format('Y') - 5;
                            if($year == 0) $year = $month;
                            if($year == 0) $year = $yearNow + 5;
                            for($i = 1; $i <= 5; $i++){ 
                        ?>
                            <option value="{{ $yearNow+$i }}"<?php if($year == $yearNow+$i) echo "selected";?>>{{ $yearNow+$i }}</option>
                        <?php } ?>
                    </select>
                </div>

                <table bordercolor="#aaa" class="col-11 col-lg-9 col-md-7 col-sm-5 col-xs-3 tmargin" border="1px">
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 15%">No. Faktur</th>
                        <th style="width: 40%">Waktu Penjualan</th>
                        <th style="width: 15%">Buku Terjual</th>
                    </tr>
                    <?php $i = (!isset($_GET['page']) || $_GET['page'] == 1) ? 1 : $_GET['page'] * 10 - 9 ; ?>
                    @foreach($penjualans as $penjualan)
                    <tr>
                        <td>{{ $i }}.</td>
                        <td><a href="/nota/{{ $penjualan->faktur_id }}">#{{ $penjualan->faktur_id }}</a></td>
                        <td class="left">{{ $controller->fullTime($penjualan->created_at) }}</td>
                        <td>{{ $penjualan->jumlah }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach 
                </table>

                <div class="col-12">{{ $penjualans->links() }}</div>

        </div>
    </main>

@endsection