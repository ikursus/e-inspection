@extends('admin.layout-induk')

@section('title', 'Detail Inspeksi')

@section('page-title', 'Detail Inspeksi')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') ?? '#' }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.inspections.index') }}">Kelola Inspeksi</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.inspections.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Kembali
    </a>
    <button class="btn btn-outline-secondary" onclick="window.print()">
        <i class="bi bi-printer me-1"></i>
        Print
    </button>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Informasi Inspeksi
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>ID Inspeksi:</strong></td>
                                <td><span class="badge bg-secondary">#{{ str_pad($inspection->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($inspection->tarikh)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Waktu:</strong></td>
                                <td>{{ $inspection->masa ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
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
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Tempat:</strong></td>
                                <td>{{ $inspection->tempat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sub Tempat:</strong></td>
                                <td>{{ $inspection->tempat_sub ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $inspection->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diperbarui:</strong></td>
                                <td>{{ $inspection->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($inspection->remarks)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6><strong>Catatan:</strong></h6>
                        <div class="bg-light p-3 rounded">
                            {{ $inspection->remarks }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Inspector Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-person-badge me-2"></i>
                    Inspector
                </h6>
            </div>
            <div class="card-body">
                @if($inspection->user)
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-person text-white"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $inspection->user->name }}</h6>
                        <small class="text-muted">{{ $inspection->user->email }}</small>
                    </div>
                </div>
                @if($inspection->user->phone)
                <p class="mb-0">
                    <i class="bi bi-telephone me-2"></i>
                    {{ $inspection->user->phone }}
                </p>
                @endif
                @else
                <p class="text-muted">Data inspector tidak tersedia</p>
                @endif
            </div>
        </div>
        
        <!-- Attachments -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-paperclip me-2"></i>
                    Lampiran ({{ $inspection->attachments->count() }})
                </h6>
            </div>
            <div class="card-body">
                @if($inspection->attachments->count() > 0)
                    @foreach($inspection->attachments as $attachment)
                    <a href="{{ asset('storage/attachments/' . $attachment->file) }}" target="_blank" class="text-decoration-none text-dark">
                        <div class="d-flex align-items-center mb-2 p-2 bg-light rounded hover-bg-secondary">
                            <i class="bi bi-file-earmark me-2"></i>
                            <div class="flex-grow-1">
                                <small class="d-block">{{ $attachment->file ?? 'File ' . $loop->iteration }}</small>
                                <small class="text-muted">{{ $attachment->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <i class="bi bi-box-arrow-up-right ms-2 text-muted"></i>
                        </div>
                    </a>
                    @endforeach
                @else
                <p class="text-muted mb-0">Tidak ada lampiran</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection