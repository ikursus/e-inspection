@extends('admin.layout-induk')

@section('title', 'Tambah Jabatan')

@section('page-title', 'Tambah Jabatan')
@section('page-description', 'Buat jabatan baru dalam sistem E-Inspection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jabatan.index') ?? '#' }}">Kelola Jabatan</a></li>
    <li class="breadcrumb-item active">Tambah Jabatan</li>
@endsection

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.jabatan.index') ?? '#' }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
        <button type="button" class="btn btn-outline-info" onclick="resetForm()">
            <i class="bi bi-arrow-clockwise me-1"></i>
            Reset
        </button>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Form Tambah Jabatan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jabatan.store') ?? '#' }}" method="POST" id="jabatanForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-briefcase me-1"></i>
                                    Nama Jabatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama jabatan"
                                       required
                                       autocomplete="off">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Contoh: Manager, Supervisor, Inspector, Admin, dll.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preview Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-eye me-2"></i>
                                        Preview Jabatan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-briefcase text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0" id="previewName">Nama Jabatan</h6>
                                            <small class="text-muted">Jabatan baru akan ditambahkan</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('admin.jabatan.index') ?? '#' }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Batal
                                    </a>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-warning" onclick="resetForm()">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Reset Form
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Simpan Jabatan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Help Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-question-circle me-2"></i>
                    Bantuan
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="bi bi-lightbulb me-1"></i> Tips:</h6>
                        <ul class="small">
                            <li>Gunakan nama jabatan yang jelas dan mudah dipahami</li>
                            <li>Hindari penggunaan karakter khusus yang tidak perlu</li>
                            <li>Pastikan nama jabatan belum ada sebelumnya</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="bi bi-list-check me-1"></i> Contoh Jabatan:</h6>
                        <ul class="small">
                            <li>Manager Operasional</li>
                            <li>Supervisor Lapangan</li>
                            <li>Inspector Keamanan</li>
                            <li>Administrator Sistem</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Real-time preview
document.getElementById('name').addEventListener('input', function() {
    const nameValue = this.value.trim();
    const previewName = document.getElementById('previewName');
    
    if (nameValue) {
        previewName.textContent = nameValue;
    } else {
        previewName.textContent = 'Nama Jabatan';
    }
});

// Reset form function
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
        document.getElementById('jabatanForm').reset();
        document.getElementById('previewName').textContent = 'Nama Jabatan';
        
        // Remove validation classes
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-valid', 'is-invalid');
        });
        
        // Focus on first input
        document.getElementById('name').focus();
    }
}

// Form validation
document.getElementById('jabatanForm').addEventListener('submit', function(e) {
    const nameInput = document.getElementById('name');
    const submitBtn = document.getElementById('submitBtn');
    
    // Disable submit button to prevent double submission
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Menyimpan...';
    
    // Basic validation
    if (!nameInput.value.trim()) {
        e.preventDefault();
        nameInput.classList.add('is-invalid');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Simpan Jabatan';
        nameInput.focus();
        return false;
    }
    
    nameInput.classList.remove('is-invalid');
    nameInput.classList.add('is-valid');
});

// Auto-focus on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').focus();
});

// Character counter (optional enhancement)
document.getElementById('name').addEventListener('input', function() {
    const maxLength = 255;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;
    
    // You can add a character counter display here if needed
    if (remaining < 50) {
        this.classList.add('border-warning');
    } else {
        this.classList.remove('border-warning');
    }
    
    if (remaining < 0) {
        this.classList.add('border-danger');
    } else {
        this.classList.remove('border-danger');
    }
});
</script>
@endpush