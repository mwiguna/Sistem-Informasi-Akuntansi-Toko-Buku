	<div class="buttonMenu close">&nbsp;</div>
    <div class="col-2 col-lg-10 menu-btn">
        <div class="col-12 sub-title">Admin</div>
        <a href="/home" class="col-12 sub-btn">Tambah Penjualan</a>
        <a href="/daftar/penjualan" class="col-12 sub-btn">Daftar Penjualan</a>
        <a href="/pembelian" class="col-12 sub-btn">Tambah Pembelian</a>
        <a href="/daftar/pembelian" class="col-12 sub-btn">Daftar Pembelian</a>
        <a href="/daftar/buku" class="col-12 sub-btn">Daftar Buku</a>
        <a class="col-12 sub-btn" onclick="document.getElementById('logout').submit();">Logout</a>
        <form id="logout" action="{{ url('/logout') }}" method="POST">{{ csrf_field() }}</form>
    </div>

    @yield('menu')