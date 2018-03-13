<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Penjualan;
use App\Pembelian;
use App\Book;
use DB;
use DateTime;
date_default_timezone_set("Asia/Jakarta");

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/login');   
    }

    public function home()
    {
        if(Auth::user()->name == "admin") return view('admin.home');
        else if(Auth::user()->name == "gudang"){
            $book = Book::orderBy('id', 'DESC')->first();
            $id   = $book->id + 1;

            return view('gudang.home', ['id' => $id]);
        }
        else {
            $date = new DateTime;
            $penjualan = DB::table('penjualans')
                    ->whereMonth('penjualans.created_at', $date->format('m'))
                    ->whereYear('penjualans.created_at', $date->format('Y'))
                    ->select(DB::raw('SUM(penjualans.jumlah) as jumlah, SUM(penjualans.jumlah*books.harga) as total'))
                    ->join('books', 'penjualans.buku_id', '=', 'books.id')
                    ->first();
            $transaksi = DB::table('penjualans')
                    ->whereMonth('penjualans.created_at', $date->format('m'))
                    ->whereYear('penjualans.created_at', $date->format('Y'))
                    ->select(DB::raw('COUNT(faktur_id) as total'))
                    ->groupBy('faktur_id')
                    ->get();
            $transaksi = count($transaksi);

            return view('pemilik.home', ['penjualan' => $penjualan, 'transaksi' => $transaksi, 'date' => $date]);
        }
    }
}
