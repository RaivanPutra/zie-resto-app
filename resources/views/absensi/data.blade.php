    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Waktu Masuk</th>
                                    <th>Status</th>
                                    <th>Waktu Selesai Kerja</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->namaKaryawan }}</td>
                                    <td>{{ $a->tanggalMasuk }}</td>
                                    <td>{{ $a->waktuMasuk }}</td>
                                    <td>
                                        <select id="status_{{ $a->id }}" name="status" class="form-control">
                                            <option value="masuk">Masuk</option>
                                            <option value="cuti">Cuti</option>
                                            <option value="sakit">Sakits</option>
                                        </select>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary btnSelesai" data-id="{{ $a->id }}">Selesai</button>
                                    </td>

                                    <td>
                                        <form method="post" style="display: inline"
                                            action="{{ url(request()->segment(1) . '/' . $a->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" title="Delete" class="btn btn-danger delete-data">
                                                <i class="fas fa-trash danger"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formAbsensiModal"
                                            data-mode="edit" data-id="{{ $a->id }}" data-namaKaryawan="{{ $a->namaKaryawan }}" data-tanggalMasuk="{{ $a->tanggalMasuk }}" data-waktuMasuk="{{ $a->waktuMasuk }}" data-status="{{ $a->status }}" data-waktuKeluar="{{ $a->waktuKeluar }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btnSelesai').click(function() {
                let id = $(this).data('id');
                let selectStatus = $('#status_' + id);
                let waktuSekarang = new Date();
                let jam = waktuSekarang.getHours();
                let menit = waktuSekarang.getMinutes();
                let detik = waktuSekarang.getSeconds();
                let waktuString = jam + ":" + menit + ":" + detik;

                // Ubah teks tombol menjadi waktu
                $(this).text(waktuString);

                // Kirim data via AJAX
                $.ajax({
                    url: "{{ url('absensi') }}/" + id, // Ganti dengan URL endpoint Anda
                    method: 'PUT', // Menggunakan metode PUT karena Anda ingin mengupdate data
                    data: {
                        waktuKeluar: waktuString,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle sukses, misalnya tampilkan pesan
                        console.log('Data berhasil dikirim:', response);
                    },
                    error: function(error) {
                        // Handle error, misalnya tampilkan pesan error
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    @endpush
