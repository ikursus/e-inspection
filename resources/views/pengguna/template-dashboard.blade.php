@extends('pengguna.layout-induk')

@section('page-title')
    Dashboard
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Total Inspeksi</h6>
                    <h3 class="mb-0 text-dark">1,234</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Selesai</h6>
                    <h3 class="mb-0 text-dark">987</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +8% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Pending</h6>
                    <h3 class="mb-0 text-dark">156</h3>
                    <small class="text-warning">
                        <i class="fas fa-minus"></i> -2% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center">
                <div class="stats-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="ms-3">
                    <h6 class="text-muted mb-1">Bermasalah</h6>
                    <h3 class="mb-0 text-dark">91</h3>
                    <small class="text-danger">
                        <i class="fas fa-arrow-down"></i> -15% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity and Quick Actions -->
<div class="row">
    <div class="col-xl-8 mb-4">
        <div class="recent-activity">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Aktivitas Terbaru</h5>
                <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); font-size: 1rem;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Inspeksi Baru Ditambahkan</h6>
                        <p class="text-muted mb-0">Inspeksi keselamatan gedung A oleh John Doe</p>
                    </div>
                    <small class="text-muted">2 menit lalu</small>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981, #059669); font-size: 1rem;">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Inspeksi Selesai</h6>
                        <p class="text-muted mb-0">Inspeksi rutin lantai 3 telah diselesaikan</p>
                    </div>
                    <small class="text-muted">15 menit lalu</small>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f59e0b, #d97706); font-size: 1rem;">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Peringatan Sistem</h6>
                        <p class="text-muted mb-0">Inspeksi ID #1234 memerlukan perhatian</p>
                    </div>
                    <small class="text-muted">1 jam lalu</small>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); font-size: 1rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Laporan Dibuat</h6>
                        <p class="text-muted mb-0">Laporan bulanan Oktober 2024 telah dibuat</p>
                    </div>
                    <small class="text-muted">3 jam lalu</small>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #06b6d4, #0891b2); font-size: 1rem;">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Pengguna Baru</h6>
                        <p class="text-muted mb-0">Jane Smith bergabung sebagai inspector</p>
                    </div>
                    <small class="text-muted">5 jam lalu</small>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="d-flex align-items-center">
                    <div class="stats-icon me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f97316, #ea580c); font-size: 1rem;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Jadwal Inspeksi</h6>
                        <p class="text-muted mb-0">Inspeksi gedung B dijadwalkan untuk besok</p>
                    </div>
                    <small class="text-muted">1 hari lalu</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-4">
        <div class="recent-activity">
            <h5 class="mb-3">Aksi Cepat</h5>
            
            <div class="d-grid gap-3">
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>
                    Buat Inspeksi Baru
                </button>
                
                <button class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-file-download me-2"></i>
                    Unduh Laporan
                </button>
                
                <button class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-calendar me-2"></i>
                    Jadwal Inspeksi
                </button>
                
                <button class="btn btn-outline-info btn-lg">
                    <i class="fas fa-chart-line me-2"></i>
                    Lihat Analitik
                </button>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded">
                <h6 class="mb-2">Tips Hari Ini</h6>
                <p class="text-muted mb-0 small">
                    Pastikan untuk melakukan inspeksi rutin setiap minggu untuk menjaga kualitas dan keamanan.
                </p>
            </div>
            
            <div class="mt-3 p-3 bg-primary bg-opacity-10 rounded">
                <h6 class="mb-2 text-primary">Statistik Ringkas</h6>
                <div class="row text-center">
                    <div class="col-4">
                        <div class="fw-bold text-primary">80%</div>
                        <small class="text-muted">Selesai</small>
                    </div>
                    <div class="col-4">
                        <div class="fw-bold text-warning">13%</div>
                        <small class="text-muted">Pending</small>
                    </div>
                    <div class="col-4">
                        <div class="fw-bold text-danger">7%</div>
                        <small class="text-muted">Masalah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    alert('Selamat Datangs');
</script>
@endpush

@push('scripts')
<script>
    alert('Selamat Test');
</script>
@endpush