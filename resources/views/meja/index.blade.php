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
                    data-bs-target="#formMejaModal">
                    <i class="bi bi-plus"></i> Tambah meja
                </button>
                </button>
                    <a href="{{ route('export-meja') }}" class="btn btn-primary block">
                    <i class="bi bi-file-earmark-excel-fill"></i> Export</a>
                    <button type="button" class="btn btn-warning block" data-bs-toggle="modal"
                    data-bs-target="#formInputModal">
                    <i class="bi bi-file-earmark-excel-fill"></i> Import
                </button>
            </div>
            <div class="card-body">
                @include('meja.data')
            </div>
        </div>
        @include('meja.form')
        @include('meja.formInput')
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
$('#formMejaModal').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget)
    console.log(btn.data('mode'))
    const mode = btn.data('mode')
    const no_meja = btn.data('no_meja')
    const kapasitas = btn.data('kapasitas')
    const status = btn.data('status')
    const id = btn.data('id')
    const modal = $(this)
    if (mode == 'edit') {
        modal.find('#method').html('@method('PATCH')')
        modal.find('.modal-title').text('Edit Data Meja')
        modal.find('#no_meja').val(no_meja)
        modal.find('#kapasitas').val(kapasitas)
        modal.find('#status').val(status)
        modal.find('.modal-body form').attr('action', '{{ url('meja') }}/' + id)
    } else {
        modal.find('.modal-title').text('Input Data Meja')
        modal.find('#no_meja').val('')
        modal.find('#kapasitas').val('')
        modal.find('#status').val('')
        modal.find('#method').html('')
        modal.find('.modal-body form').attr('action', '{{ url('meja') }}')
    }
})
</script>
@endpush