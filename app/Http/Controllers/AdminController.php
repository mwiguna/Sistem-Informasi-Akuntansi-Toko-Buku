<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Auth;
use DB;
use App\Book;
use App\Penjualan;
use App\Pembelian;
date_default_timezone_set("Asia/Jakarta");

class AdminController extends Controller
{
    public function infoBuku(Request $request){
    	$kode   = $request->kode;
    	$book   = Book::find($kode);
        if(!$book) return "0";

    	$judul  = $book->judul;
    	$harga  = $book->harga;
    	$jumlah = $request->jumlah;
    	$total  = $harga * $jumlah;
    	$harga  = "Rp. ".number_format($harga, 0, ",", ".");
    	$total  = "Rp. ".number_format($total, 0, ",", ".");

    	$book   = ["judul" => $judul, "harga" => $harga, "jumlah" => $jumlah, "total" => $total];
    	return $book;
    }

    public function addPenjualan(Request $request){
        $barangs = $request->barang;
        $nota    = new Penjualan;
        $data    = [];
        $faktur  = Penjualan::orderBy('penjualan_id', 'DESC')->first();
        if(!$faktur) $faktur = 1;
        else $faktur = $faktur->faktur_id + 1;
        
        $i = 0;
        foreach($barangs as $barang){
            $data[$i]["faktur_id"]  = $faktur;
            $data[$i]["buku_id"]    = $barang[0];
            $data[$i]["jumlah"]     = $barang[1];
            $data[$i]["created_at"] = date("Y-m-d H:i:s");
            $data[$i]["updated_at"] = date("Y-m-d H:i:s");

            $buku       = Book::find($barang[0]);
            $buku->stok = $buku->stok - $barang[1];
            $buku->save();
            $i++;
        }

        Penjualan::insert($data);
        return $faktur;
    }

    public function nota($faktur){
        $notas = DB::table('penjualans')->where('penjualans.faktur_id', $faktur)
                                        ->join('books', 'penjualans.buku_id', '=', 'books.id')
                                        ->get(['penjualans.*', 'books.judul', 'books.penerbit', 'books.harga']);
        return view('admin.nota', ['notas' => $notas, 'controller' => $this]);
    }

    public function daftarPenjualan($m = 0, $y = 0){
        $date = new DateTime;
        if($m != 0 && $y != 0){
            $penjualans = DB::table('penjualans')
                    ->whereMonth('penjualans.created_at', $m)
                    ->whereYear('penjualans.created_at', $y)
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        } else if($m == 0 && $y == 0){
            $penjualans = DB::table('penjualans')
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        } else {
            $penjualans = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $m)
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        }
        
        return view('admin.penjualan', ['date' => $date, 'penjualans' => $penjualans, 'controller' => $this, 'month' => $m, 'year' => $y]);
    }

    public function pembelian(){
        return view('admin.pembelian');
    }

    public function addPembelian(Request $request){
        $beli = new Pembelian;
        $data = [];
        $faktur  = Pembelian::orderBy('pembelian_id', 'DESC')->first();
        if(!$faktur) $faktur = 1;
        else $faktur = $faktur->faktur_id + 1;

        $i = 0;
        foreach($request->barang as $barang){
            $data[$i]["faktur_id"]  = $faktur;
            $data[$i]["nama"]       = $barang[0];
            $data[$i]["jumlah"]     = $barang[1];
            $data[$i]["harga"]      = $barang[2];
            $data[$i]["supplier"]   = $barang[3];
            $data[$i]["created_at"] = date("Y-m-d H:i:s");
            $data[$i]["updated_at"] = date("Y-m-d H:i:s");
            $i++;
        }

        Pembelian::insert($data);
    }

    public function daftarPembelian($m = 0, $y = 0){
        $date = new DateTime;
        if($m != 0 && $y != 0){
            $pembelians = DB::table('pembelians')
                    ->whereMonth('created_at', $m)
                    ->whereYear('created_at', $y)
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah, SUM(harga*jumlah) as harga'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        } else if($m == 0 && $y == 0){
            $pembelians = DB::table('pembelians')
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah, SUM(harga*jumlah) as harga'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        } else {
            $pembelians = DB::table('pembelians')
                    ->select('faktur_id', 'created_at', DB::raw('SUM(jumlah) as jumlah, SUM(harga*jumlah) as harga'))
                    ->groupBy('faktur_id', 'created_at')
                    ->paginate(10);
        }
        
        return view('admin.daftarPembelian', ['date' => $date, 'pembelians' => $pembelians, 'controller' => $this, 'month' => $m, 'year' => $y]);
    }

    public function notaPembelian($faktur){
        $notas = Pembelian::where('faktur_id', $faktur)->get();
        return view('admin.notaPembelian', ['notas' => $notas, 'controller' => $this]);
    }

    public function daftarBuku(){
        $books = Book::paginate(8);
        return view('admin.daftarBuku', ['books' => $books, 'controller' => $this]);
    }

    public function penerbitBuku($id){
        $books = Book::where('penerbit', $id)->paginate(8);
        return view('admin.daftarBuku', ['books' => $books, 'controller' => $this]);
    }

    public function kategoriBuku($id){
        $books = Book::where('kategori', $id)->paginate(8);
        return view('admin.daftarBuku', ['books' => $books, 'controller' => $this]);
    }

    public function cariBuku($id){
        $books = Book::where('judul', 'LIKE', '%'.$id.'%')->paginate(8);
        return view('admin.daftarBuku', ['books' => $books, 'controller' => $this]);
    }

    public function buku($id){
        $book  = Book::find($id);
        return view('admin.buku', ['book' => $book,'controller' => $this]); 
    }

    public function cetakBuku(){
        $books = Book::paginate(20);
        return view('admin.cetakBuku', ['books' => $books, 'controller' => $this]);
    }

    public function editBook(Request $request){
        $book = Book::find($request->kode);
        $book->id       = $request->kode;
        $book->judul    = $request->judul;
        $book->penerbit = $request->penerbit;
        $book->kategori = $request->kategori;
        $book->harga    = $request->harga;
        $book->stok     = $request->stok;
        $book->save();

        return redirect('/daftar/buku')->with('msg', 'Berhasil mengubah data buku.');
    }

    public function addBook(Request $request){
        $book = Book::where('id', $request->kode)->first();
        if($book) return redirect('/home')->with('msg', 'Kode buku sudah terdaftar.');

        $book = new Book;
        $book->id       = $request->kode;
        $book->judul    = $request->judul;
        $book->penerbit = $request->penerbit;
        $book->kategori = $request->kategori;
        $book->harga    = $request->harga;
        $book->stok     = $request->stok;
        $book->save();

        return redirect('/home')->with('msg', 'Berhasil menambahkan buku.');
    }

    public function deletePembelian($id){
        $pembelian = Pembelian::where('pembelian_id', $id)->delete();

        return redirect('/daftar/pembelian')->with('msg', 'Berhasil menghapus pembelian.');
    }

    public function mainLabaRugi($month, $year){

        if($month == 0){
            $this->penjualan = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $year)
                    ->select(DB::raw('SUM(penjualans.jumlah*books.harga) as total'))
                    ->join('books', 'penjualans.buku_id', '=', 'books.id')
                    ->first();
            $this->pembelian = DB::table('pembelians')
                    ->whereYear('pembelians.created_at', $year)
                    ->select(DB::raw('SUM(harga*jumlah) as total'))
                    ->first();
        } else {
            $this->penjualan = DB::table('penjualans')
                    ->whereMonth('penjualans.created_at', $month)
                    ->whereYear('penjualans.created_at', $year)
                    ->select(DB::raw('SUM(penjualans.jumlah*books.harga) as total'))
                    ->join('books', 'penjualans.buku_id', '=', 'books.id')
                    ->first();
            $this->pembelian = DB::table('pembelians')
                    ->whereMonth('pembelians.created_at', $month)
                    ->whereYear('pembelians.created_at', $year)
                    ->select(DB::raw('SUM(harga*jumlah) as total'))
                    ->first();
        }
    }

    public function labarugi(){
        $date = new DateTime;
        self::mainLabaRugi($date->format('m'), $date->format('Y'));

        return view('pemilik.labarugi', ['penjualan' => $this->penjualan, 'pembelian' => $this->pembelian, 'date' => $date]);
    }

    public function getLabaRugi(Request $request){
        self::mainLabaRugi($request->month, $request->year);
        $ket   = "Laba";
        $total = $this->penjualan->total - $this->pembelian->total;
        if($total < 0){
            $total = $total * -1;
            $ket   = "Rugi";
        }
        $total     = "Rp. ".number_format($total, 0, ',', '.').",-";
        $penjualan = "Rp. ".number_format($this->penjualan->total, 0, ',', '.').",-";
        $pembelian = "Rp. ".number_format($this->pembelian->total, 0, ',', '.').",-";

        $data = ['penjualan' => $penjualan, 'pembelian' => $pembelian, 'total' => $total, 'ket' => $ket];
        return $data;
    }

    public function getPenjualan(Request $request){
        $month = $request->month;
        $year  = $request->year;
        if($month == 0){
            $penjualan = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $year)
                    ->select(DB::raw('SUM(penjualans.jumlah) as jumlah, SUM(penjualans.jumlah*books.harga) as total'))
                    ->join('books', 'penjualans.buku_id', '=', 'books.id')
                    ->first();
            $transaksi = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $year)
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
        } else {
            $penjualan = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $year)
                    ->whereMonth('penjualans.created_at', $month)
                    ->select(DB::raw('SUM(penjualans.jumlah) as jumlah, SUM(penjualans.jumlah*books.harga) as total'))
                    ->join('books', 'penjualans.buku_id', '=', 'books.id')
                    ->first();
            $transaksi = DB::table('penjualans')
                    ->whereYear('penjualans.created_at', $year)
                    ->whereMonth('penjualans.created_at', $month)
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
        }

        $jumlah    = ($penjualan->jumlah) ? $penjualan->jumlah : 0;
        $buku      = $jumlah." Buku";
        $penjualan = "Rp. ".number_format($penjualan->total, 0, ',', '.').",-";
        $transaksi = ($transaksi) ? count($transaksi) : 0;

        $data = ['penjualan' => $penjualan, 'buku' => $buku, 'transaksi' => $transaksi];
        return $data;
    }

    public function laporanPembelian(){
        $date = new DateTime;
        $month = $date->format('m');
        $year  = $date->format('Y');
        $penjualan = DB::table('pembelians')
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('SUM(jumlah) as jumlah, SUM(jumlah*harga) as total'))
                    ->first();
        $transaksi = DB::table('pembelians')
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
        $transaksi = count($transaksi);

        return view('pemilik.pembelian', ['penjualan' => $penjualan, 'transaksi' => $transaksi, 'date' => $date]);
    }

    public function getPembelian(Request $request){
        $month = $request->month;
        $year  = $request->year;

        if($month == 0){
            $pembelian = DB::table('pembelians')
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('SUM(jumlah) as jumlah, SUM(jumlah*harga) as total'))
                    ->first();
            $transaksi = DB::table('pembelians')
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
        } else {
            $pembelian = DB::table('pembelians')
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('SUM(jumlah) as jumlah, SUM(jumlah*harga) as total'))
                    ->first();
            $transaksi = DB::table('pembelians')
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
        }

        $transaksi = count($transaksi);

        $jumlah = ($pembelian->jumlah) ? $pembelian->jumlah." Barang" : "0 Barang";
        $total  = "Rp. ".number_format($pembelian->total, 0, ',', '.').",-";

        $data = ['total' => $total, 'jumlah' => $jumlah, 'transaksi' => $transaksi];
        return $data;
    }


    /* --------------------- Without Routing ---------------------- */


    public function tanggal($tgl){
        $date  = new DateTime($tgl);
        $month = array('Januari', 'Februari', 'Maret' , 'April' , 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $time  = $date->format('d')." ".$month[$date->format('m')]." ".$date->format('Y'); 
        return $time;
    }

    public function fullTime($tgl){
        $date  = new DateTime($tgl);
        $month = array('Januari', 'Februari', 'Maret' , 'April' , 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $time  = $date->format('d')." ".$month[$date->format('m')]." ".$date->format('Y')." Pukul : ".$date->format("H:i:s"); 
        return $time;
    }
}
