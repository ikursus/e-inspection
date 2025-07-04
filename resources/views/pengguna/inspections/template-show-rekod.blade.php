@extends('pengguna.layout-induk')

@section('page-title', 'Lihat Rekod Inspeksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Detail Rekod Inspeksi
                </h5>
            </div>
            <div class="card-body">
                @if($inspection)
                    <div class="row">
                        <!-- Tarikh -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Tarikh
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ \Carbon\Carbon::parse($inspection->tarikh) }}
                            </div>
                        </div>
                        
                        <!-- Masa -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-clock me-1"></i>
                                Masa
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ \Carbon\Carbon::parse($inspection->masa) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Tempat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                Tempat
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $inspection->tempat }}
                            </div>
                        </div>
                        
                        <!-- Tempat Sub -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-pin me-1"></i>
                                Lokasi Spesifik
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $inspection->tempat_sub ?? 'Tidak dinyatakan' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Remarks -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-comment-alt me-1"></i>
                            Catatan/Remarks
                        </label>
                        <div class="form-control-plaintext border rounded p-3 bg-light" style="min-height: 100px; white-space: pre-wrap;">
                            {{ $inspection->remarks }}
                        </div>
                    </div>
                    
                    <!-- Attachments -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fas fa-paperclip me-1"></i>
                            Lampiran
                        </label>
                        <div class="border rounded p-3 bg-light">
                            
                            @if($attachments->count() > 0)
                                <div class="row">
                                    @foreach($attachments as $attachment)
                                        <div class="col-md-6 col-lg-4 mb-2">
                                            <div class="d-flex align-items-center p-2 border rounded bg-white">
                                                @php
                                                    $extension = pathinfo($attachment->file, PATHINFO_EXTENSION);
                                                    $iconClass = 'fas fa-file';
                                                    if(in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                        $iconClass = 'fas fa-image text-success';
                                                    } elseif($extension == 'pdf') {
                                                        $iconClass = 'fas fa-file-pdf text-danger';
                                                    } elseif(in_array($extension, ['doc', 'docx'])) {
                                                        $iconClass = 'fas fa-file-word text-primary';
                                                    } elseif(in_array($extension, ['xls', 'xlsx'])) {
                                                        $iconClass = 'fas fa-file-excel text-success';
                                                    }
                                                @endphp
                                                <i class="{{ $iconClass }} me-2"></i>
                                                <div class="flex-grow-1">
                                                    <small class="text-truncate d-block" title="{{ $attachment->file }}">
                                                        {{ $attachment->file }}
                                                    </small>
                                                </div>
                                                <a href="{{ asset('storage/attachments/' . $attachment->file) }}" 
                                                   class="btn btn-sm btn-outline-primary ms-2" 
                                                   target="_blank" 
                                                   title="Lihat/Muat turun">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted text-center py-3">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Tiada lampiran untuk rekod ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Maklumat Tambahan -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user me-1"></i>
                                ID Pengguna
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $inspection->user_id }}
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-plus me-1"></i>
                                Tarikh Dicipta
                            </label>
                            <div class="form-control-plaintext border rounded p-2 bg-light">
                                {{ $inspection->created_at }}
                            </div>
                        </div>
                    </div>
                    
                @else
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <h5>Rekod Tidak Dijumpai</h5>
                        <p class="mb-0">Rekod inspeksi yang diminta tidak wujud atau telah dipadam.</p>
                    </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('user.inspections.rekod') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali ke Senarai
                    </a>
                    @if($inspection)
                        <div>
                            <a href="#" class="btn btn-outline-primary me-2">
                                <i class="fas fa-edit me-1"></i>
                                Edit Rekod
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="fas fa-print me-1"></i>
                                Cetak
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-control-plaintext {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
}

.attachment-item:hover {
    background-color: #f8f9fa;
}

@media print {
    .btn, .card-header {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endpush