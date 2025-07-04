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
                        <th>Masa</th>
                        <th>Tempat</th>
                        <th>Tempat Sub</th>
                        <th>Remarks</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($senaraiInspection as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tarikh }}</td>
                        <td>{{ $item->masa }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->tempat_sub }}</td>
                        <td>{{ $item->remarks }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <div class="form-group">
                <select class="form-control" id="per-page-select" onchange="window.location.href='{{ route('user.inspections.rekod') }}?bilangan=' + this.value">
                    <option value="3" {{ request('bilangan') == '3' ? 'selected' : '' }}>3 items per page</option>
                    <option value="10" {{ request('bilangan') == '10' ? 'selected' : '' }}>10 items per page</option>
                    <option value="25" {{ request('bilangan') == '25' ? 'selected' : '' }}>25 items per page</option>
                    <option value="50" {{ request('bilangan') == '50' ? 'selected' : '' }}>50 items per page</option>
                    <option value="100" {{ request('bilangan') == '100' ? 'selected' : '' }}>100 items per page</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $senaraiInspection->appends(['bilangan' => request('bilangan')])->links() }}
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