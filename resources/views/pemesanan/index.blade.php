@extends('template.layout')

@push('style')
    <style>
        .card {
            margin-bottom: 20px; /* Memberikan jarak antara kartu-kartu */
            width: 18rem; /* Menetapkan lebar tetap untuk kartu */
        }

        .row.match-height {
            margin-bottom: 20px; /* Memberikan jarak antara baris kartu-kartu */
        }

        /* Style untuk bagian transaksi */
        #transaction {
            display: flex;
            flex-direction: column;
        }

        #transaction-list {
            list-style-type: none;
            padding: 0;
        }

        #transaction-list li {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-item {
            cursor: pointer;
        }

        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity input {
            width: 40px;
            text-align: center;
        }

        /* Tambahkan overflow-y untuk membuat menu dapat di-scroll */
        .card-menu {
            overflow-y: auto;
            max-height: 400px; /* Atur tinggi maksimum menu yang dapat di-scroll */
        }
    </style>
@endpush

@section('container')
    <!-- Main Content -->
    <section id="groups">
        <div class="row match-height">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <select class="form-select jenis-menu">
                            <option value="">Semua Jenis</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->nama_jenis }}">{{ $j->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach($jenis as $j)
                        <div class="col-md-6 card-menu">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ $j->nama_jenis }}</h4>
                                </div>
                                @foreach($j->menu as $m)
                                    <div class="card-body">
                                        <div class="card-group gap-3" style="width: 200px;">
                                            <div class="card" style="height:17rem;">
                                                <div class="card-content">
                                                    <img class="card-img-top img-fluid" src="{{ asset('storage/menu-image/' . $m->image) }}" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ $m->nama_menu }}</h4>
                                                        <p class="card-text">
                                                            Rp. {{ $m->harga }} <!-- Menambahkan label "Rp." pada harga -->
                                                        </p>
                                                        <small class="text-muted">Last updated {{ $m->updated_at->diffForHumans() }}.</small>
                                                        <button class="btn btn-primary btn-sm add-to-cart" data-nama="{{ $m->nama_menu }}" data-harga="{{ $m->harga }}"><i class="bi bi-cart-plus-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <!-- Transaction Section -->
<section id="transaction">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="section-title text-uppercase">Transaksi</h4>
                    <ul id="transaction-list">
                        <!-- Daftar transaksi akan ditampilkan di sini -->
                    </ul>
                    <p id="total-harga">Total: Rp. 0</p> <!-- Tambahkan elemen untuk menampilkan total harga -->
                    
                    <!-- Input field untuk memasukkan jumlah uang -->
                    <div class="mb-3">
                        <label for="jumlah-uang" class="form-label">Jumlah Uang</label>
                        <input type="number" class="form-control" id="jumlah-uang" placeholder="Masukkan jumlah uang">
                    </div>
                    
                    <!-- Button untuk melakukan pembayaran -->
                    <button type="button" class="btn btn-primary" id="btn-bayar">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Transaction Section -->

            </div>
        </div>
    </section>
    <!-- End Main -->
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            // Fungsi untuk menjumlahkan total harga transaksi
            function hitungTotalHarga() {
                var totalHarga = 0;
                $("#transaction-list li").each(function() {
                    var harga = parseInt($(this).find(".harga").text().replace('Rp. ', '').replace(',', ''));
                    var qty = parseInt($(this).find(".quantity input").val());
                    totalHarga += harga * qty;
                });
                $("#total-harga").text('Total: Rp. ' + totalHarga);
            }

            $(".jenis-menu").change(function(){
                var jenis = $(this).val();
                $(".card-menu").hide();
                if (jenis === "") {
                    $(".card-menu").show();
                } else {
                    $(".card-menu").each(function(){
                        if($(this).find('.card-header h4').text() === jenis){
                            $(this).show();
                        }
                    });
                }
            });
 
            $(".add-to-cart").click(function(){
                var namaMenu = $(this).data('nama');
                var hargaMenu = $(this).data('harga');

                // Periksa apakah menu sudah ada di dalam transaksi
                var existingItem = $("#transaction-list li").filter(function() {
                    return $(this).find(".nama").text() === namaMenu;
                });

                if (existingItem.length > 0) {
                    // Jika menu sudah ada, tambahkan jumlahnya
                    var quantityInput = existingItem.find(".quantity input");
                    var currentQty = parseInt(quantityInput.val());
                    quantityInput.val(currentQty + 1);
                } else {
                    // Jika menu belum ada, tambahkan menu baru ke dalam transaksi
                    var listItem = '<li><span class="nama">' + namaMenu + '</span> ';
                    listItem += '<div class="quantity">';
                    listItem += '<button class="btn btn-secondary btn-sm minus">-</button>';
                    listItem += '<input type="text" class="form-control form-control-sm mx-1" value="1" disabled>';
                    listItem += '<button class="btn btn-secondary btn-sm plus">+</button>';
                    listItem += '</div>';
                    listItem += '<span class="harga">Rp. ' + hargaMenu + '</span>';
                    listItem += '<button type="button" class="btn-close remove-item" aria-label="Remove" data-nama="' + namaMenu + '"></button></li>';

                    $("#transaction-list").append(listItem);
                }

                // Hitung total harga setelah menambahkan item
                hitungTotalHarga();
            });

            // Hapus item transaksi saat tombol hapus diklik
            $(document).on("click", ".remove-item", function(){
                $(this).parent().remove();

                // Hitung total harga setelah menghapus item
                hitungTotalHarga();
            });

            // Tambah atau kurangi jumlah item saat tombol plus atau minus diklik
            $(document).on("click", ".plus", function(){
                var input = $(this).siblings("input");
                var currentValue = parseInt(input.val());
                input.val(currentValue + 1);

                // Hitung total harga saat menambah jumlah item
                hitungTotalHarga();
            });

            $(document).on("click", ".minus", function(){
                var input = $(this).siblings("input");
                var currentValue = parseInt(input.val());
                if (currentValue > 1) {
                    input.val(currentValue - 1);

                    // Hitung total harga saat mengurangi jumlah item
                    hitungTotalHarga();
                }
            });

            $(document).ready(function(){
    // Fungsi untuk menghitung kembalian uang
    function hitungKembalian(totalHarga, jumlahUang) {
        if (jumlahUang >= totalHarga) {
            var kembalian = jumlahUang - totalHarga;
            return kembalian;
        } else {
            return null; // Jika jumlah uang kurang dari total harga, kembalian tidak valid
        }
    }

    // Event listener untuk tombol bayar
    $("#btn-bayar").click(function(){
        var totalHarga = parseInt($("#total-harga").text().replace('Total: Rp. ', '').replace(',', ''));
        var jumlahUang = parseInt($("#jumlah-uang").val());

        // Periksa apakah jumlah uang valid
        if (isNaN(jumlahUang) || jumlahUang <= 0) {
            alert("Jumlah uang tidak valid. Harap masukkan angka yang lebih besar dari 0.");
            return;
        }

        // Hitung kembalian
        var kembalian = hitungKembalian(totalHarga, jumlahUang);

        // Tampilkan kembalian jika jumlah uang valid dan mencukupi
        if (kembalian !== null) {
            alert("Kembalian: Rp. " + kembalian);
        } else {
            alert("Jumlah uang yang dimasukkan tidak mencukupi.");
        }
    });
});
        });
    </script>
@endpush
