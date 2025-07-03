@extends('admin.layout-induk')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')
@section('page-description', 'Selamat datang di panel admin E-Inspection System')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('page-actions')
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#quickActionModal">
            <i class="bi bi-lightning me-1"></i>
            Quick Action
        </button>
        <button class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>
            Buat Inspeksi
        </button>
    </div>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-white-50 small">Total Pengguna</div>
                    <div class="h4 mb-0 text-white font-weight-bold">1,245</div>
                    <div class="small text-white-50">
                        <i class="bi bi-arrow-up"></i> 12% dari bulan lalu
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <i class="bi bi-people display-6 text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-white-50 small">Inspeksi Selesai</div>
                    <div class="h4 mb-0 text-white font-weight-bold">892</div>
                    <div class="small text-white-50">
                        <i class="bi bi-arrow-up"></i> 8% dari bulan lalu
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <i class="bi bi-check-circle display-6 text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-white-50 small">Inspeksi Pending</div>
                    <div class="h4 mb-0 text-white font-weight-bold">156</div>
                    <div class="small text-white-50">
                        <i class="bi bi-arrow-down"></i> 3% dari bulan lalu
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <i class="bi bi-clock display-6 text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card danger">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-white-50 small">Masalah Ditemukan</div>
                    <div class="h4 mb-0 text-white font-weight-bold">23</div>
                    <div class="small text-white-50">
                        <i class="bi bi-arrow-up"></i> 5% dari bulan lalu
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <i class="bi bi-exclamation-triangle display-6 text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Recent Activity -->
<div class="row">
    <!-- Chart Section -->
    <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart me-2"></i>
                    Statistik Inspeksi Bulanan
                </h5>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        2024
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">2024</a></li>
                        <li><a class="dropdown-item" href="#">2023</a></li>
                        <li><a class="dropdown-item" href="#">2022</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <canvas id="inspectionChart" width="100%" height="40"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-activity me-2"></i>
                    Aktivitas Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle p-2">
                                <i class="bi bi-plus text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">Inspeksi Baru Dibuat</div>
                            <div class="small text-muted">Inspeksi gedung A oleh John Doe</div>
                            <div class="small text-muted">2 menit yang lalu</div>
                        </div>
                    </div>
                    
                    <div class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success rounded-circle p-2">
                                <i class="bi bi-check text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">Inspeksi Selesai</div>
                            <div class="small text-muted">Inspeksi ruang server diselesaikan</div>
                            <div class="small text-muted">15 menit yang lalu</div>
                        </div>
                    </div>
                    
                    <div class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning rounded-circle p-2">
                                <i class="bi bi-exclamation text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">Masalah Ditemukan</div>
                            <div class="small text-muted">Kerusakan pada sistem ventilasi</div>
                            <div class="small text-muted">1 jam yang lalu</div>
                        </div>
                    </div>
                    
                    <div class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info rounded-circle p-2">
                                <i class="bi bi-person text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">Pengguna Baru</div>
                            <div class="small text-muted">Jane Smith bergabung sebagai inspector</div>
                            <div class="small text-muted">3 jam yang lalu</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua Aktivitas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Inspections and Quick Actions -->
<div class="row">
    <!-- Recent Inspections -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Inspeksi Terbaru
                </h5>
                <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Lokasi</th>
                                <th>Inspector</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-secondary">#INS-001</span></td>
                                <td>Gedung A - Lantai 1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">JD</div>
                                        John Doe
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>15 Jan 2024</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-secondary">#INS-002</span></td>
                                <td>Ruang Server</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">JS</div>
                                        Jane Smith
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>14 Jan 2024</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-secondary">#INS-003</span></td>
                                <td>Gedung B - Lantai 2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">MB</div>
                                        Mike Brown
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Berlangsung</span></td>
                                <td>13 Jan 2024</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Buat Inspeksi Baru
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah Pengguna
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Generate Laporan
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="bi bi-gear me-2"></i>
                        Pengaturan Sistem
                    </button>
                </div>
                
                <hr>
                
                <h6 class="mb-3">Shortcut Menu</h6>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-people d-block mb-1"></i>
                            <small>Users</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-clipboard-data d-block mb-1"></i>
                            <small>Reports</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-gear d-block mb-1"></i>
                            <small>Settings</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-question-circle d-block mb-1"></i>
                            <small>Help</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Modal -->
<div class="modal fade" id="quickActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-lightning me-2"></i>
                    Quick Action
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 100px;">
                            <i class="bi bi-plus-circle display-6 mb-2"></i>
                            <span>Buat Inspeksi</span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 100px;">
                            <i class="bi bi-person-plus display-6 mb-2"></i>
                            <span>Tambah User</span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 100px;">
                            <i class="bi bi-file-earmark-text display-6 mb-2"></i>
                            <span>Generate Report</span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 100px;">
                            <i class="bi bi-gear display-6 mb-2"></i>
                            <span>Pengaturan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Configuration
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('inspectionChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Inspeksi Selesai',
                data: [65, 78, 90, 81, 95, 88, 92, 85, 98, 89, 94, 87],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Masalah Ditemukan',
                data: [12, 15, 8, 18, 10, 14, 9, 16, 7, 13, 11, 15],
                borderColor: '#dc2626',
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                }
            }
        }
    });
});

// Auto refresh data every 30 seconds
setInterval(function() {
    // Here you can add AJAX call to refresh dashboard data
    console.log('Refreshing dashboard data...');
}, 30000);
</script>
@endpush