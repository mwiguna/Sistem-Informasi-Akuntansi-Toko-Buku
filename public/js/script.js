    
    $(document).ready(function(){
            
        /* --------- Admin ---------- */

            function openMenu(){
                $('.open').addClass('close');
                $('.open').removeClass('open');
                $('.menu-btn').animate({marginLeft: "-0"}, 400, function(){
                    $('.content').addClass('col-10');
                });
            }

            $(window).resize(function(){ openMenu(); });
            $(document).on("click", ".open", function(){ openMenu(); });
            $(document).on("click", ".close", function(){
                $('.close').addClass('open');
                $('.close').removeClass('close');
                $('.menu-btn').animate({marginLeft: "-17%"}, 400);
                $('.content').removeClass('col-10');
            });

            var barang = [];
            $(document).on("submit", "#addBook", function() {
                var kode   = $("#kode").val();
                var jumlah = $("#jumlah").val();
                var token  = $("input[name='_token']").val();
                
                $("#kode").val("");
                $("#jumlah").val("");
                $("#kode").focus();
                
                $.ajax({
                    method: "POST",
                    url: "/infoBuku",
                    data: { _token: token, kode: kode, jumlah: jumlah},
                    success: function(data){
                        if(data == "0") alert("Buku tidak ditemukan!");
                        else {
                            var judul  = data.judul;
                            var harga  = data.harga;
                            var jumlah = data.jumlah;
                            var total  = data.total;
                            barang.push([kode, jumlah]);

                            var id = $("tr:last-child").attr("data-id") * 1 + 1;
                            if(isNaN(id)){
                                var id = 1;
                                $(".pesanan").append('<table bordercolor="#aaa" class="col-12" border="1px"><tr><th style="width: 2%">No.</th><th style="width: 15%">Kode Buku</th><th>Judul Buku</th><th>Harga</th><th style="width: 10%">Jumlah</th><th>Total</th></tr></table>'); 
                            }
                            $("table").append('<tr data-id="'+id+'"><td>'+id+'.</td><td>'+kode+'</td><td>'+judul+'</td><td>'+harga+'</td><td>'+jumlah+'</td><td>'+total+'</td></tr>');
                        }
                                                
                    }
                });
            });

            $(document).on("submit", "#submit", function(){
                var token = $("input[name='_token']").val();
                $.ajax({
                    method: "POST",
                    url: "/addPenjualan",
                    data: { _token: token, barang: barang},
                    success: function(faktur){
                        window.location.href = "/nota/"+faktur;
                    }
                });
            });

            $(document).on("submit", "#addBeli", function() {
                var nama     = $("#nama").val();
                var jumlah   = $("#jumlah").val();
                var harga    = $("#harga").val();
                var supplier = $("#supplier").val();
                var token    = $("input[name='_token']").val();
                
                $("#nama").val("");
                $("#jumlah").val("");
                $("#harga").val("");
                $("#supplier").val("");
                $("#nama").focus();
            
                barang.push([nama, jumlah, harga, supplier]);

                var id = $("tr:last-child").attr("data-id") * 1 + 1;
                if(isNaN(id)){
                    var id = 1;
                    $(".pesanan").append('<table bordercolor="#aaa" class="col-12" border="1px"><tr><th style="width: 2%">No.</th><th style="width: 35%">Nama Barang</th><th style="width: 10%">Jumlah</th><th style="width: 20%">Harga</th><th>Supplier</th></tr></table>'); 
                }
                $("table").append('<tr data-id="'+id+'"><td>'+id+'.</td><td>'+nama+'</td><td>'+jumlah+'</td><td>Rp. '+harga+'</td><td>'+supplier+'</td></tr>');
            });

            $(document).on("submit", "#pembelian", function(){
                var token = $("input[name='_token']").val();
                $.ajax({
                    method: "POST",
                    url: "/addPembelian",
                    data: { _token: token, barang: barang},
                    success: function(msg){
                        window.location.href = "/pembelian";
                    }
                });
            });

            var month = $("#monthpn").val();
            if(month == 0) $("#monthpn").css({width: '5px'});
            else $("#monthpn").css({width: 'auto'});

            $(document).on("change", "#monthpn, #yearpn", function(){
                var token = $("input[name='_token']").val();
                var month = $("#monthpn").val();
                var year  = $("#yearpn").val();
                if(month == 0) $("#monthpn").css({width: '5px'});
                else $("#monthpn").css({width: 'auto'}); 
                
                if(month != 0) window.location.href = "/daftar/penjualan/"+month+"/"+year;
                else window.location.href = "/daftar/penjualan/"+year;
            });

            /*----------------------------------------------*/

            var monthb = $("#monthpb").val();
            if(monthb == 0) $("#monthpb").css({width: '5px'});
            else $("#monthpb").css({width: 'auto'});

            $(document).on("change", "#monthpb, #yearpb", function(){
                var token = $("input[name='_token']").val();
                var month = $("#monthpb").val();
                var year  = $("#yearpb").val();
                if(month == 0) $("#monthpb").css({width: '5px'});
                else $("#monthpb").css({width: 'auto'}); 
                
                if(month != 0) window.location.href = "/daftar/pembelian/"+month+"/"+year;
                else window.location.href = "/daftar/pembelian/"+year;
            });

            $(document).on("click", "#btn-cari", function(){
                var index = $("#judul").val();
                if(index == "") alert("Mohon isi kolom pencarian.");
                else window.location.href = "/cari/buku/"+index;
            });


        /* --------- Owner ---------- */


            $(document).on("change", "#monthlr, #yearlr", function(){
                var token = $("input[name='_token']").val();
                var month = $("#monthlr").val();
                var year  = $("#yearlr").val(); 
                
                $.ajax({
                    method: "POST",
                    url: "/getLabaRugi",
                    data: { _token: token, month: month, year: year},
                    success: function(data){
                        $("#penjualan").html(data.penjualan);
                        $("#pembelian").html(data.pembelian);
                        $("#total").html(data.total);
                        $("#ket").html(data.ket);
                        if(month == 0) $("#monthlr").css({width: '5px'});
                        else $("#monthlr").css({width: 'auto'});
                    }
                });
            });

            $(document).on("change", "#monthp, #yearp", function(){
                var token = $("input[name='_token']").val();
                var month = $("#monthp").val();
                var year  = $("#yearp").val(); 
                
                $.ajax({
                    method: "POST",
                    url: "/getPenjualan",
                    data: { _token: token, month: month, year: year},
                    success: function(data){
                        $("#buku").html(data.buku);
                        $("#penjualan").html(data.penjualan);
                        $("#transaksi").html(data.transaksi);
                        if(month == 0) $("#monthp").css({width: '5px'});
                        else $("#monthp").css({width: 'auto'});
                    }
                });
            });

            $(document).on("change", "#monthpm, #yearpm", function(){
                var token = $("input[name='_token']").val();
                var month = $("#monthpm").val();
                var year  = $("#yearpm").val(); 
                
                $.ajax({
                    method: "POST",
                    url: "/getPembelian",
                    data: { _token: token, month: month, year: year},
                    success: function(data){
                        $("#barang").html(data.jumlah);
                        $("#pengeluaran").html(data.total);
                        $("#transaksi").html(data.transaksi);
                        if(month == 0) $("#monthpm").css({width: '5px'});
                        else $("#monthpm").css({width: 'auto'});
                    }
                });
            });

    });