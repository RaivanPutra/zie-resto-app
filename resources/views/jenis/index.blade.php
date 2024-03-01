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
                    data-bs-target="#formJenisModal">
                    <i class="bi bi-plus"></i> Tambah Jenis
                </button>
            </div>
            <div class="card-body">
                @include('jenis.data')
            </div>
        </div>
    </section>
</div>
@endsection
<!-- End Main -->
@include('jenis.form')
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
$('#formJenisModal').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget)
    console.log(btn.data('mode'))
    const mode = btn.data('mode')
    const nama_jenis = btn.data('nama_jenis')
    const id = btn.data('id')
    const modal = $(this)
    if (mode == 'edit') {
        modal.find('#method').html('@method('
            PATCH ')')
        modal.find('.modal-title').text('Edit Data Jenis')
        modal.find('#nama_jenis').val(nama_jenis)
        modal.find('.modal-body form').attr('action', '{{ url('
            jenis ') }}/' + id)
    } else {
        modal.find('.modal-title').text('Input Data Jenis')
        modal.find('#nama_jenis').val('')
        modal.find('#method').html('')
        modal.find('.modal-body form').attr('action', '{{ url('
            jenis ') }}')
    }
})
</script>
@endpush