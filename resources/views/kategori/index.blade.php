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
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                    data-bs-target="#formKategoriModal">
                    <i class="bi bi-plus"></i> Tambah Kategori
                </button>
                </button>
                    <a href="{{ route('export-kategori') }}" class="btn btn-primary block">
                    <i class="bi bi-file-earmark-excel-fill"></i> Export</a>
                    <button type="button" class="btn btn-warning block" data-bs-toggle="modal"
                    data-bs-target="#formInputModal">
                    <i class="bi bi-file-earmark-excel-fill"></i> Import
                </button>
            </div>
            <div class="card-body">
                @include('kategori.data')
            </div>
        </div>
        @include('kategori.form')
        @include('kategori.formInput')
    </section>
</div>
@endsection
<!-- End Main -->
<script src="dist/assets/extensions/jquery/jquery.min.js"></script>
<script src="dist/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="dist/assets/static/js/pages/parsley.js"></script>

@push('script')
<script>
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
$('#formKategoriModal').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget)
    console.log(btn.data('mode'))
    const mode = btn.data('mode')
    const nama_kategori = btn.data('nama_kategori')
    const id = btn.data('id')
    const modal = $(this)
    if (mode == 'edit') {
        modal.find('#method').html('@method('PATCH')')
        modal.find('.modal-title').text('Edit Data Kategori')
        modal.find('#nama_kategori').val(nama_kategori)
        modal.find('.modal-body form').attr('action', '{{ url('kategori') }}/' + id)
    } else {
        modal.find('.modal-title').text('Input Data Kategori')
        modal.find('#nama_kategori').val('')
        modal.find('#method').html('')
        modal.find('.modal-body form').attr('action', '{{ url('kategori') }}')
    }
})
</script>
@endpush