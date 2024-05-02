@extends('template.layout')

@section('container')
<!-- Konten Utama -->
<div class="page-content">
    <section class="section">
        <!-- Kartu Profil Perusahaan -->
        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <!-- Gambar -->
                <div class="col-md-4">
                    <img src="{{ asset('img/download.jpeg') }}" class="img-fluid rounded-start" alt="Gambar Perusahaan">
                </div>
                <!-- Teks -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">PT Makmur Sejahtera</h5>
                        <p class="card-text">Deskripsi singkat tentang PT Makmur Sejahtera. Anda bisa menambahkan informasi lebih lanjut di sini untuk memberikan gambaran kepada pengunjung.</p>
                        <p class="card-text"><small class="text-muted">Terakhir diperbarui 3 menit yang lalu</small></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Peta Lokasi dan Form Pertanyaan -->
        <div class="row">
            <!-- Peta Lokasi -->
            <div class="col-lg-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-white">
                        <h5 class="card-title">Lokasi Kami</h5>
                    </div>
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9 mb-4">
                            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.57311654129782!3d-6.903273917028756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1633023222539!5m2!1sen!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen loading="lazy"></iframe>
                        </div>
                        <p class="card-text"><strong>Alamat:</strong> Jl. Contoh No. 123, Bandung</p>
                        <p class="card-text"><strong>Telepon:</strong> (022) 1234567</p>
                        <p class="card-text"><strong>Email:</strong> info@ptmakmur.com</p>
                    </div>
                </div>
            </div>
            
            <!-- Form Pertanyaan -->
            <div class="col-lg-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-white">
                        <h5 class="card-title">Hubungi Developer</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subjek</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
@endpush
