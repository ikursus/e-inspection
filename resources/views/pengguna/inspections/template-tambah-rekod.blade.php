@extends('pengguna.layout-induk')

@section('page-title', 'Tambah Rekod Inspeksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Rekod Inspeksi Baru
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.inspections.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <ul style="margin: 0; padding-left: 1.25rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="row">
                        <!-- Tarikh -->
                        <div class="col-md-6 mb-3">
                            <label for="tarikh" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Tarikh <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tarikh') is-invalid @enderror" 
                                   id="tarikh" 
                                   name="tarikh" 
                                   value="{{ old('tarikh', date('Y-m-d')) }}" 
                                   required>
                            @error('tarikh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Masa -->
                        <div class="col-md-6 mb-3">
                            <label for="masa" class="form-label">
                                <i class="fas fa-clock me-1"></i>
                                Masa <span class="text-danger">*</span>
                            </label>
                            <input type="time" 
                                   class="form-control @error('masa') is-invalid @enderror" 
                                   id="masa" 
                                   name="masa" 
                                   value="{{ old('masa', date('H:i')) }}" 
                                   required>
                            @error('masa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Tempat -->
                        <div class="col-md-6 mb-3">
                            <label for="tempat" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                Tempat <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('tempat') is-invalid @enderror" 
                                    id="tempat" 
                                    name="tempat" 
                                    required>
                                <option value="">Pilih Tempat</option>
                                <option value="Pejabat Utama" {{ old('tempat') == 'Pejabat Utama' ? 'selected' : '' }}>Pejabat Utama</option>
                                <option value="Cawangan A" {{ old('tempat') == 'Cawangan A' ? 'selected' : '' }}>Cawangan A</option>
                                <option value="Cawangan B" {{ old('tempat') == 'Cawangan B' ? 'selected' : '' }}>Cawangan B</option>
                                <option value="Gudang" {{ old('tempat') == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                <option value="Kilang" {{ old('tempat') == 'Kilang' ? 'selected' : '' }}>Kilang</option>
                            </select>
                            @error('tempat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Tempat Sub -->
                        <div class="col-md-6 mb-3">
                            <label for="tempat_sub" class="form-label">
                                <i class="fas fa-map-pin me-1"></i>
                                Lokasi Spesifik
                            </label>
                            <input type="text" 
                                   class="form-control @error('tempat_sub') is-invalid @enderror" 
                                   id="tempat_sub" 
                                   name="tempat_sub" 
                                   value="{{ old('tempat_sub') }}" 
                                   placeholder="Contoh: Tingkat 2, Bilik 201">
                            @error('tempat_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Remarks -->
                    <div class="mb-3">
                        <label for="remarks" class="form-label">
                            <i class="fas fa-comment-alt me-1"></i>
                            Catatan/Remarks <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" 
                                  id="remarks" 
                                  name="remarks" 
                                  rows="4" 
                                  placeholder="Masukkan catatan atau pemerhatian inspeksi..." 
                                  required>{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Attachments -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-paperclip me-1"></i>
                            Lampiran (Multiple Files)
                        </label>
                        <div class="border rounded p-3 bg-light">
                            <div id="attachment-container">
                                <div class="attachment-item mb-2">
                                    <div class="input-group">
                                        <input type="file" 
                                               class="form-control" 
                                               name="attachments[]" 
                                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                        <button type="button" class="btn btn-outline-danger remove-attachment" style="display: none;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-attachment">
                                <i class="fas fa-plus me-1"></i>
                                Tambah Lampiran
                            </button>
                            <small class="form-text text-muted d-block mt-2">
                                Format yang dibenarkan: JPG, PNG, PDF, DOC, DOCX, XLS, XLSX (Maksimum 5MB per file)
                            </small>
                        </div>
                        @error('attachments.*')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.inspections.rekod') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>
                        <div>
                            <button type="reset" class="btn btn-outline-warning me-2">
                                <i class="fas fa-undo me-1"></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Simpan Rekod
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addAttachmentBtn = document.getElementById('add-attachment');
    const attachmentContainer = document.getElementById('attachment-container');
    
    // Add new attachment field
    addAttachmentBtn.addEventListener('click', function() {
        const newAttachment = document.createElement('div');
        newAttachment.className = 'attachment-item mb-2';
        newAttachment.innerHTML = `
            <div class="input-group">
                <input type="file" 
                       class="form-control" 
                       name="attachments[]" 
                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                <button type="button" class="btn btn-outline-danger remove-attachment">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        attachmentContainer.appendChild(newAttachment);
        updateRemoveButtons();
    });
    
    // Remove attachment field
    attachmentContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-attachment')) {
            e.target.closest('.attachment-item').remove();
            updateRemoveButtons();
        }
    });
    
    // Update remove button visibility
    function updateRemoveButtons() {
        const attachmentItems = attachmentContainer.querySelectorAll('.attachment-item');
        attachmentItems.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-attachment');
            if (attachmentItems.length > 1) {
                removeBtn.style.display = 'block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }
    
    // File size validation
    attachmentContainer.addEventListener('change', function(e) {
        if (e.target.type === 'file') {
            const file = e.target.files[0];
            if (file && file.size > 5 * 1024 * 1024) { // 5MB
                alert('Ukuran file terlalu besar. Maksimum 5MB per file.');
                e.target.value = '';
            }
        }
    });
});
</script>
@endpush