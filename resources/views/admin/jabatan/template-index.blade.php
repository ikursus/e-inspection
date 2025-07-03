@extends('admin.layout-induk')

@section('title', 'Kelola Jabatan')

@section('page-title', 'Kelola Jabatan')
@section('page-description', 'Manajemen data jabatan dalam sistem E-Inspection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Jabatan</li>
@endsection

@section('content')
<div class="d-flex gap-2">
        <a href="{{ route('admin.jabatan.create') ?? '#' }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Jabatan
        </a>
        <button class="btn btn-outline-secondary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>
            Print
        </button>
    </div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-briefcase me-2"></i>
                    Daftar Jabatan
                </h5>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari jabatan...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($senaraiJabatan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="jabatanTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">ID</th>
                                <th width="50%">Nama Jabatan</th>
                                <th width="15%">Dibuat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($senaraiJabatan as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-secondary">#{{ str_pad($jabatan->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-briefcase text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $jabatan->name }}</h6>
                                            <small class="text-muted">Jabatan ID: {{ $jabatan->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($jabatan->created_at)->format('d M Y') }}
                                        <br>
                                        {{ \Carbon\Carbon::parse($jabatan->created_at)->format('H:i') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Lihat Detail"
                                                onclick="viewJabatan({{ $jabatan->id }}, '{{ $jabatan->name }}')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.jabatan.edit', $jabatan->id) ?? '#' }}" 
                                           class="btn btn-outline-warning btn-sm"
                                           data-bs-toggle="tooltip" 
                                           data-bs-placement="top" 
                                           title="Edit Jabatan">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Hapus Jabatan"
                                                onclick="deleteJabatan({{ $jabatan->id }}, '{{ $jabatan->name }}')">
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
                                <h4 class="mb-0">{{ $senaraiJabatan->count() }}</h4>
                                <small>Total Jabatan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiJabatan->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                                <small>Bulan Ini</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiJabatan->where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                                <small>Minggu Ini</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiJabatan->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                                <small>Hari Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-briefcase display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum Ada Data Jabatan</h5>
                    <p class="text-muted mb-4">Silakan tambah jabatan baru untuk memulai.</p>
                    <a href="{{ route('admin.jabatan.create') ?? '#' }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Jabatan Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Detail Jabatan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <strong>ID:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailId"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <strong>Nama Jabatan:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailName"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                <p>Apakah Anda yakin ingin menghapus jabatan <strong id="deleteJabatanName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
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
    const tableRows = document.querySelectorAll('#jabatanTable tbody tr');
    
    tableRows.forEach(row => {
        const jabatanName = row.cells[2].textContent.toLowerCase();
        if (jabatanName.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// View jabatan detail
function viewJabatan(id, name) {
    document.getElementById('detailId').textContent = '#' + String(id).padStart(3, '0');
    document.getElementById('detailName').textContent = name;
    
    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
}

// Delete jabatan
function deleteJabatan(id, name) {
    document.getElementById('deleteJabatanName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/jabatan/${id}/delete`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush