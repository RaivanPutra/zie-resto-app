@extends('template.layout')

@push('style')

@endpush

@section('container')
<!-- Main Content -->
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <form method="GET" action="{{ route('home') }}">
                    <div class="form-group">
                        <label for="tanggal">Filter berdasarkan Tanggal:</label>
                        <!-- Tambahkan value untuk mempertahankan nilai tanggal saat mengirimkan form -->
                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $tanggal ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    <button class="btn btn-primary mb-2"><a href="/" class="text-white text-decoration-none">Refresh</a></button>
                </form>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5 d-flex align-items-center">
                            <div class="stats-icon purple mb-2 me-3">
                                <i class="iconly-boldChart"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Total Transaksi</h6>
                                <h5 class="font-extrabold mb-2">{{ $jumlahTransaksi }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5 d-flex align-items-center">
                            <div class="stats-icon purple mb-2 me-3">
                                <i class="iconly-boldChart"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Transaksi</h6>
                                <h5 class="font-extrabold mb-2">{{ $transactionToday }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5 d-flex align-items-center">
                            <div class="stats-icon green mb-2 me-3">
                                <i class="iconly-boldBag"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Pendapatan</h6>
                                <h6 class="font-extrabold mb-2">Rp. {{ $jumlahPendapatan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5 d-flex align-items-center">
                            <div class="stats-icon red mb-2 me-3">
                                <i class="iconly-boldGraph"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Jumlah Stok</h6>
                                <h6 class="font-extrabold mb-2">{{ $jumlahStok }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="dist/assets/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ $name }}</h5>
                            <h6 class="text-muted mb-0">{{ $level }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Menu Terpopuler di ZieResto</h5>
                    <ul class="list-group">
                        @foreach ($menus as $menu)
                            <li class="list-group-item">{{ $menu['name'] }} - Total Terjual: {{ $menu['total_terjual'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Pendapatan</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@push('script')
<!-- Tambahkan script untuk Chart.js di sini -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($transactions->pluck('date')) !!},
            datasets: [{
                label: 'Total Pendapatan',
                data: {!! json_encode($transactions->pluck('total_harga')) !!},
                borderColor: 'blue',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let value = context.dataset.data[context.dataIndex];
                        return 'Rp ' + tooltipItem.formattedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            }
        }
    });
</script>
@endpush