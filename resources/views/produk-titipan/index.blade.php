@extends('template.layout')

@push('style')

@endpush
<!-- Main Content -->
@section('container')
<div class="page-content">
    <section class="section">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <i class="bi bi-check-circle"></i> Success! {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible show fade">
            @foreach ($errors->all() as $error)
            <i class="bi bi-file-excel"></i> Error! {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card">
            <div class="card-header ms-2">
                <button type="button" class="btn btn-success block" data-bs-toggle="modal"
                    data-bs-target="#formProdukModal">
                    <i class="bi bi-plus"></i> Tambah Data
                </button>
                    <a href="{{ route('export-produk') }}" class="btn btn-primary block">
                    <i class="bi bi-file-earmark-excel-fill"></i> Export</a>
                    <button type="button" class="btn btn-warning block" data-bs-toggle="modal"
                    data-bs-target="#formInputModal">
                    <i class="bi bi-file-earmark-excel-fill"></i> Import
                </button>
            </div>
            <div class="card-body">
                @include('produk-titipan.data')
            </div>
        </div>
        @include('produk-titipan.form')
        @include('produk-titipan.formInput')
    </section>
</div>
@endsection
<!-- End Main -->
<script src="dist/assets/extensions/jquery/jquery.min.js"></script>
<script src="dist/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="dist/assets/static/js/pages/parsley.js"></script>

@push('script')
<script>
    // Fungsi untuk menghitung harga jual otomatis
    $(document).ready(function() {
    // Ketika nilai harga beli berubah
    $('#harga_beli').on('input', function() {
        // Ambil nilai harga beli
        var hargaBeli = parseFloat($(this).val());

        // Jika harga beli valid (angka)
        if (!isNaN(hargaBeli)) {
            // Hitung harga jual dengan keuntungan 70%
            var keuntungan = hargaBeli * 0.7;

            // Bulatkan ke kelipatan 500
            var hargaJual = Math.round((hargaBeli + keuntungan) / 500) * 500;

            // Tampilkan harga jual di input harga jual
            $('#harga_jual').val(hargaJual);
        }
    });
});

// Ketika elemen stok di-double klik
$('body').on('dblclick', '.editable-stok', function() {
    // Simpan nilai awal stok
    var oldValue = $(this).data('value');
    
    // Ubah elemen stok menjadi input field
    $(this).html('<input type="number" class="form-control" value="' + oldValue + '">');

    // Fokuskan pada input field
    $(this).find('input').focus();
});

// Ketika pengguna menekan tombol pada input field stok
$('body').on('keyup', '.editable-stok input', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Mencegah perilaku default tombol Enter

        // Ambil nilai baru dari input field
        var newValue = $(this).val().trim();
        var oldValue = $(this).closest('.editable-stok').data('value');
        
        // Jika nilai baru berbeda dari nilai lama
        if (newValue != oldValue) {
            // Ambil ID produk dari atribut data-id
            var productId = $(this).closest('td').data('id');

            // Kirim permintaan AJAX untuk memperbarui nilai stok di database
        $.ajax({
            url: '/produk-titipan/' + productId + '/update-stok',
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { stok: newValue },
            success: function(response) {
                // Tanggapan sukses dari server
                console.log(response.message);
                // Lakukan tindakan sesuai kebutuhan, misalnya, memperbarui tampilan
            },
            error: function(xhr, status, error) {
        // Tangani kesalahan jika terjadi
        console.error(xhr.responseText);
    }
});
        } else {
            // Jika tidak ada perubahan, kembalikan ke tampilan teks aslinya
            $(this).closest('.editable-stok').text(oldValue);
        }
    }
});



$('.delete-data').click(function(e) {
    e.preventDefault()
    const data = $(this).closest('tr').find('td:eq(1)').text()
    Swal.fire({
            title: 'Data akan hilang!',
            text: `Apakah penghapusan data ${data} akan dilanjutkan ? `,
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak',
            focusConfirm: false
        })
        .then((result) => {
            if (result.isConfirmed) $(e.target).closest('form').submit()
            else swal.close()
        })
    })
// Function Edit
$('#formProdukModal').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget)
    console.log(btn.data('mode'))
    const mode = btn.data('mode')
    const nama_produk = btn.data('nama_produk')
    const nama_supplier = btn.data('nama_supplier')
    const harga_beli = btn.data('harga_beli')
    const harga_jual = btn.data('harga_jual')
    const stok = btn.data('stok')
    const keterangan = btn.data('keterangan')
    const id = btn.data('id')
    const modal = $(this)
    if (mode == 'edit') {
        modal.find('#method').html('@method('PATCH')')
        modal.find('.modal-title').text('Edit Data Jenis')
        modal.find('#nama_produk').val(nama_produk)
        modal.find('#nama_produk').val(nama_produk)
        modal.find('#nama_supplier').val(nama_supplier)
        modal.find('#harga_beli').val(harga_beli)
        modal.find('#harga_jual').val(harga_jual)
        modal.find('#stok').val(stok)
        modal.find('#keterangan').val(keterangan)
        modal.find('.modal-body form').attr('action', '{{ url('titipan') }}/' + id)
    } else {
        modal.find('.modal-title').text('Input Data Produk Titipan')
        modal.find('#nama_peroduk').val('')
        modal.find('#nama_supplier').val('')
        modal.find('#harga_beli').val('')
        modal.find('#harga_jual').val('')
        modal.find('#stok').val('')
        modal.find('#keterangan').val('')
        modal.find('#method').html('')
        modal.find('.modal-body form').attr('action', '{{ url('titipan') }}')
    }
})
</script>
@endpush