@extends('admin.layout-induk')

@section('title', 'Kelola Inspeksi')

@section('page-title', 'Kelola Inspeksi')
@section('page-description', 'Manajemen data inspeksi dalam sistem E-Inspection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Inspeksi</li>
@endsection

@section('content')
<div class="d-flex gap-2 mb-5">
    <button class="btn btn-outline-secondary" onclick="window.print()">
        <i class="bi bi-printer me-1"></i>
        Print
    </button>
    <button class="btn btn-outline-success" onclick="exportData()">
        <i class="bi bi-file-earmark-excel me-1"></i>
        Export
    </button>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Daftar Inspeksi
                </h5>
                <div class="d-flex gap-2">
                    <select class="form-select" id="statusFilter" style="width: 150px;">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari inspeksi...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($inspections->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="inspectionsTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">ID</th>
                                <th width="25%">Inspector</th>
                                <th width="15%">Tanggal & Waktu</th>
                                <th width="25%">Tempat</th>
                                <th width="10%">Status</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inspections as $inspection)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-secondary">#{{ str_pad($inspection->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info rounded-circle p-2 me-3" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person-badge text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $inspection->user->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $inspection->user->email ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ \Carbon\Carbon::parse($inspection->tarikh)->format('d/m/Y') }}</strong><br>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $inspection->masa ?? '-' }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $inspection->tempat }}</strong>
                                        @if($inspection->tempat_sub)
                                            <br><small class="text-muted">{{ $inspection->tempat_sub }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($inspection->status == 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($inspection->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($inspection->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($inspection->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.inspections.show', $inspection->id) }}" 
                                           class="btn btn-outline-info btn-sm"
                                           data-bs-toggle="tooltip" 
                                           data-bs-placement="top" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Hapus Inspeksi"
                                                onclick="deleteInspection({{ $inspection->id }}, '{{ $inspection->tempat }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Statistics -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $inspections->count() }}</h4>
                                <small>Total Inspeksi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $inspections->where('status', 'completed')->count() }}</h4>
                                <small>Selesai</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $inspections->where('status', 'pending')->count() }}</h4>
                                <small>Pending</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $inspections->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                                <small>Hari Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-x display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum Ada Data Inspeksi</h5>
                    <p class="text-muted mb-4">Belum ada data inspeksi yang tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus inspeksi di <strong id="deleteInspectionPlace"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#inspectionsTable tbody tr');
    
    tableRows.forEach(row => {
        const inspectorName = row.cells[2].textContent.toLowerCase();
        const place = row.cells[4].textContent.toLowerCase();
        if (inspectorName.includes(searchTerm) || place.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    const selectedStatus = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#inspectionsTable tbody tr');
    
    tableRows.forEach(row => {
        const status = row.cells[5].textContent.toLowerCase();
        if (selectedStatus === '' || status.includes(selectedStatus)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Delete inspection
function deleteInspection(id, place) {
    document.getElementById('deleteInspectionPlace').textContent = place;
    document.getElementById('deleteForm').action = `/admin/inspections/${id}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Export functionality
function exportData() {
    window.location.href = '/admin/inspections/export';
}
</script>
@endpush