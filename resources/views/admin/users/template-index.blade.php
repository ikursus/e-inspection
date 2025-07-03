@extends('admin.layout-induk')

@section('title', 'Kelola Users')

@section('page-title', 'Kelola Users')
@section('page-description', 'Manajemen data pengguna dalam sistem E-Inspection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Users</li>
@endsection

@section('content')
<div class="d-flex gap-2 mb-5">
    <a href="{{ route('admin.users.create') ?? '#' }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah User
    </a>
    <button class="btn btn-outline-secondary" onclick="window.print()">
        <i class="bi bi-printer me-1"></i>
        Print
    </button>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-people me-2"></i>
                    Daftar Users
                </h5>
                <div class="d-flex gap-2">
                    <div class="input-group" style="width: 250px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari user...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($senaraiUsers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="usersTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">ID</th>
                                <th width="25%">Nama & Email</th>
                                <th width="15%">Phone</th>
                                <th width="15%">Jabatan</th>
                                <th width="10%">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($senaraiUsers as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-secondary">#{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $user->phone ?? '-' }}
                                    </small>
                                </td>
                                <td>
                                    @if($user->jabatan_name)
                                        <span class="badge bg-info">{{ $user->jabatan_name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-info btn-sm" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Lihat Detail"
                                                onclick="viewUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', '{{ $user->jabatan_name }}', '{{ $user->status }}')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.users.edit', $user->id) ?? '#' }}" 
                                           class="btn btn-outline-warning btn-sm"
                                           data-bs-toggle="tooltip" 
                                           data-bs-placement="top" 
                                           title="Edit User">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Hapus User"
                                                onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
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
                                <h4 class="mb-0">{{ $senaraiUsers->count() }}</h4>
                                <small>Total Users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiUsers->where('status', 'active')->count() }}</h4>
                                <small>User Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiUsers->where('status', 'inactive')->count() }}</h4>
                                <small>User Tidak Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h4 class="mb-0">{{ $senaraiUsers->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                                <small>Hari Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-people display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum Ada Data User</h5>
                    <p class="text-muted mb-4">Silakan tambah user baru untuk memulai.</p>
                    <a href="{{ route('admin.users.create') ?? '#' }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah User Pertama
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
                    Detail User
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
                        <strong>Nama:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailName"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailEmail"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailPhone"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <strong>Jabatan:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailJabatan"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-8">
                        <span id="detailStatus"></span>
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
                <p>Apakah Anda yakin ingin menghapus user <strong id="deleteUserName"></strong>?</p>
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
    const tableRows = document.querySelectorAll('#usersTable tbody tr');
    
    tableRows.forEach(row => {
        const userName = row.cells[2].textContent.toLowerCase();
        const userEmail = row.cells[2].textContent.toLowerCase();
        if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// View user detail
function viewUser(id, name, email, phone, jabatan, status) {
    document.getElementById('detailId').textContent = '#' + String(id).padStart(3, '0');
    document.getElementById('detailName').textContent = name;
    document.getElementById('detailEmail').textContent = email;
    document.getElementById('detailPhone').textContent = phone || '-';
    document.getElementById('detailJabatan').textContent = jabatan || 'Tidak Ada';
    document.getElementById('detailStatus').textContent = status === 'active' ? 'Aktif' : 'Tidak Aktif';
    
    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
}

// Delete user
function deleteUser(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/users/${id}/delete`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush