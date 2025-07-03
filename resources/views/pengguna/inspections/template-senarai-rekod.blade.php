@extends('pengguna.layout-induk')

@section('page-title')
Senarai Inspection
@stop

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Senarai Inspection</h4>
        <div>
            <a href="{{ route('user.inspections.borang') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Inspection Baru
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="inspection-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tarikh</th>
                        <th>No. Rujukan</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2024-03-15</td>
                        <td>INS/2024/001</td>
                        <td>Bangunan A, Tingkat 2</td>
                        <td><span class="badge bg-success">Selesai</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2024-03-14</td>
                        <td>INS/2024/002</td>
                        <td>Bangunan B, Tingkat 1</td>
                        <td><span class="badge bg-warning">Dalam Proses</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>2024-03-13</td>
                        <td>INS/2024/003</td>
                        <td>Bangunan C, Tingkat 3</td>
                        <td><span class="badge bg-danger">Belum Mula</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#inspection-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            }
        });
    });
</script>
@endpush



@endsection