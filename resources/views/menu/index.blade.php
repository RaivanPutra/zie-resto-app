@extends('template.layout')
@push('style')
<link rel="stylesheet" href="dist/assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="dist/assets/extensions/toastify-js/src/toastify.css">
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
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                    data-bs-target="#formMenuModal">
                    <i class="bi bi-plus"></i> Tambah Menu
                </button>
            </div>
            <div class="card-body">
                @include('menu.data')
            </div>
        </div>
        @include('menu.form')
    </section>
</div>
@endsection
<!-- End Main -->

<script src="dist/assets/extensions/jquery/jquery.min.js"></script>
<script src="dist/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="dist/assets/static/js/pages/parsley.js"></script>


@push('script')
<script>
console.log('menu')
$('.delete-data').click(function(e) {
    e.preventDefault()
    const data = $(this).closest('tr').find('td:eq(2)').text()
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
$('#formMenuModal').on('show.bs.modal', function(e) {
    console.log('form');
    const btn = $(e.relatedTarget);
    const mode = btn.data('mode');
    console.log(mode)
    const nama_menu = btn.data('nama_menu');
    const jenis_id = btn.data('jenis_id');
    const harga = btn.data('harga');
    const image = btn.data('image');
    const deskripsi = btn.data('deskripsi');
    const id = btn.data('id');
    const modal = $(this);
    if (mode === 'edit') {
        console.log(id);
        modal.find('#method').html('@method('PATCH')');
        modal.find('.modal-title').text('Edit Data Menu');
        modal.find('#nama_menu').val(nama_menu);
        modal.find('#harga').val(harga);
        modal.find('#jenis_id').val(jenis_id).change();
        // modal.find('#image').val(image);
        modal.find('#deskripsi').val(deskripsi);
        modal.find('.modal-body form').attr('action', '{{ url('menu') }}/' + id);
    } else {
        modal.find('#nama_menu').val('');
        modal.find('#harga').val('');
        modal.find('#jenis_id').val('');
        // modal.find('#image').val('');
        modal.find('#deskripsi').val('');
        modal.find('#method').html('');
        modal.find('.modal-body form').attr('action', '{{ url('menu') }}');
        modal.find('.modal-title').text('Input Data Menu');
    }
});
</script>
@endpush