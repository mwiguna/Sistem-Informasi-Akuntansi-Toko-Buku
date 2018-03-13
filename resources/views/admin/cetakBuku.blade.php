    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>

    <main class="col-12">
        <div class="col-10 content">
            
                <table bordercolor="#aaa" class="col-11 col-lg-9 col-md-7 col-sm-5 col-xs-3 tmargin" border="1px">
                    <tr>
                        <th colspan="7">
                            Daftar Stok Buku
                            <div class="col-12 tanggal mini-font">{{ $controller->tanggal("") }}</div>
                        </th>
                    </tr> 
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 10%">Kode Buku</th>
                        <th style="width: 30%">Judul</th>
                        <th style="width: 15%">Penerbit</th>
                        <th style="width: 15%">Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                    <?php $i = (!isset($_GET['page']) || $_GET['page'] == 1) ? 1 : $_GET['page'] * 20 - 19 ; ?>
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
        </div>
    </main>

    <script>window.print();</script>