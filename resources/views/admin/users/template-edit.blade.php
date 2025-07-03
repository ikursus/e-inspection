@extends('admin.layout-induk')

@section('title', 'Edit User')

@section('page-title', 'Edit User')
@section('page-description', 'Mengedit data pengguna dalam sistem E-Inspection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') ?? '#' }}">Kelola Users</a></li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection

@section('content')
<div class="d-flex gap-2 mb-5">
    <a href="{{ route('admin.users.index') ?? '#' }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Form Edit User
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) ?? '#' }}" method="POST" id="userForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person me-1"></i>
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Contoh: John Doe, Ahmad Rizki, dll.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-1"></i>
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="Masukkan alamat email"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Email harus unik dan valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone me-1"></i>
                                    Nomor Telefon
                                </label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="Masukkan nomor telefon">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Contoh: 08123456789, +60123456789
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="jabatan_id" class="form-label">
                                    <i class="bi bi-briefcase me-1"></i>
                                    Jabatan
                                </label>
                                <select class="form-select @error('jabatan_id') is-invalid @enderror" 
                                        id="jabatan_id" 
                                        name="jabatan_id">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($senaraiJabatan as $jabatan)
                                        <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $user->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                            {{ $jabatan->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Pilih jabatan untuk user ini.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-1"></i>
                                    Password Baru
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Kosongkan jika tidak ingin mengubah">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Kosongkan jika tidak ingin mengubah password.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill me-1"></i>
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Konfirmasi password baru">
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Ulangi password baru yang sama.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="status" class="form-label">
                                    <i class="bi bi-toggle-on me-1"></i>
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Status aktif/tidak aktif user.
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
                                        Preview User
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1" id="previewName">{{ $user->name }}</h6>
                                            <small class="text-muted" id="previewEmail">{{ $user->email }}</small><br>
                                            <small class="text-muted" id="previewJabatan">Jabatan</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="bi bi-check-circle me-1"></i>
                            Update User
                        </button>
                        <button type="button" class="btn btn-outline-warning" onclick="resetForm()">
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            Reset
                        </button>
                        <a href="{{ route('admin.users.index') ?? '#' }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update preview when form fields change
function updatePreview() {
    const name = document.getElementById('name').value || '{{ $user->name }}';
    const email = document.getElementById('email').value || '{{ $user->email }}';
    const jabatanSelect = document.getElementById('jabatan_id');
    const jabatan = jabatanSelect.options[jabatanSelect.selectedIndex].text || 'Jabatan';
    
    document.getElementById('previewName').textContent = name;
    document.getElementById('previewEmail').textContent = email;
    document.getElementById('previewJabatan').textContent = jabatan === 'Pilih Jabatan' ? 'Jabatan' : jabatan;
}

// Add event listeners
document.getElementById('name').addEventListener('input', updatePreview);
document.getElementById('email').addEventListener('input', updatePreview);
document.getElementById('jabatan_id').addEventListener('change', updatePreview);

// Reset form function
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form?')) {
        document.getElementById('userForm').reset();
        updatePreview();
        
        // Remove validation classes
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.classList.remove('is-valid', 'is-invalid');
        });
        
        // Focus on first input
        document.getElementById('name').focus();
    }
}

// Form validation
document.getElementById('userForm').addEventListener('submit', function(e) {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submitBtn');
    
    // Disable submit button to prevent double submission
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Mengupdate...';
    
    // Basic validation
    if (!nameInput.value.trim()) {
        e.preventDefault();
        nameInput.classList.add('is-invalid');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update User';
        nameInput.focus();
        return false;
    }
    
    if (!emailInput.value.trim()) {
        e.preventDefault();
        emailInput.classList.add('is-invalid');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update User';
        emailInput.focus();
        return false;
    }
    
    // Password validation only if password is provided
    if (passwordInput.value.trim() && passwordInput.value !== passwordConfirmInput.value) {
        e.preventDefault();
        passwordConfirmInput.classList.add('is-invalid');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update User';
        passwordConfirmInput.focus();
        return false;
    }
    
    nameInput.classList.remove('is-invalid');
    nameInput.classList.add('is-valid');
    emailInput.classList.remove('is-invalid');
    emailInput.classList.add('is-valid');
});

// Auto-focus on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('name').focus();
    updatePreview();
});
</script>
@endpush