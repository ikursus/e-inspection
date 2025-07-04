<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Senarai Inspection</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        
        .header h2 {
            color: #7f8c8d;
            font-size: 16px;
            margin: 5px 0 0 0;
            font-weight: normal;
        }
        
        .report-info {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        
        .report-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .report-info td {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .report-info .label {
            font-weight: bold;
            color: #2c3e50;
            width: 150px;
        }
        
        .summary-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .stat-box {
            text-align: center;
            flex: 1;
            margin: 0 10px;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            display: block;
        }
        
        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }
        
        th {
            background-color: #34495e;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #2c3e50;
        }
        
        td {
            padding: 10px 8px;
            border: 1px solid #bdc3c7;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e8f4f8;
        }
        
        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            color: white;
        }
        
        .status.pending {
            background-color: #f39c12;
        }
        
        .status.completed {
            background-color: #27ae60;
        }
        
        .status.cancelled {
            background-color: #e74c3c;
        }
        
        .status.in-progress {
            background-color: #3498db;
        }
        
        .attachment-count {
            background-color: #3498db;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            text-align: center;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #bdc3c7;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            
            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>LAPORAN SENARAI INSPECTION</h1>
        <h2>Sistem E-Inspection</h2>
    </div>
    
    <!-- Report Information -->
    <div class="report-info">
        <table>
            <tr>
                <td class="label">Tarikh Laporan:</td>
                <td>{{ date('d/m/Y H:i:s') }}</td>
                <td class="label">Jumlah Rekod:</td>
                <td>{{ $senaraiInspections->count() }} inspection</td>
            </tr>
            <tr>
                <td class="label">Tempoh Data:</td>
                <td>
                    @if($senaraiInspections->count() > 0)
                        {{ $senaraiInspections->min('created_at')->format('d/m/Y') }} - 
                        {{ $senaraiInspections->max('created_at')->format('d/m/Y') }}
                    @else
                        Tiada data
                    @endif
                </td>
                <td class="label">Status:</td>
                <td>Aktif</td>
            </tr>
        </table>
    </div>
    
    <!-- Summary Statistics -->
    <div class="summary-stats">
        <div class="stat-box">
            <span class="stat-number">{{ $senaraiInspections->where('status', 'completed')->count() }}</span>
            <span class="stat-label">Selesai</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $senaraiInspections->where('status', 'pending')->count() }}</span>
            <span class="stat-label">Pending</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $senaraiInspections->where('status', 'in-progress')->count() }}</span>
            <span class="stat-label">Dalam Proses</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $senaraiInspections->sum(function($inspection) { return $inspection->attachments->count(); }) }}</span>
            <span class="stat-label">Lampiran</span>
        </div>
    </div>
    
    <!-- Data Table -->
    <div class="table-container">
        @if($senaraiInspections->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 15%;">Nama Inspector</th>
                        <th style="width: 10%;">Tarikh</th>
                        <th style="width: 8%;">Masa</th>
                        <th style="width: 15%;">Tempat</th>
                        <th style="width: 12%;">Tempat Sub</th>
                        <th style="width: 20%;">Remarks</th>
                        <th style="width: 8%;">Status</th>
                        <th style="width: 7%;">Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($senaraiInspections as $index => $inspection)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $inspection->user->name ?? 'N/A' }}</strong><br>
                                <small style="color: #7f8c8d;">{{ $inspection->user->email ?? '' }}</small>
                            </td>
                            <td>{{ $inspection->tarikh ? date('d/m/Y', strtotime($inspection->tarikh)) : 'N/A' }}</td>
                            <td>{{ $inspection->masa ?? 'N/A' }}</td>
                            <td>{{ $inspection->tempat ?? 'N/A' }}</td>
                            <td>{{ $inspection->tempat_sub ?? 'N/A' }}</td>
                            <td>
                                <div style="max-width: 150px; word-wrap: break-word;">
                                    {{ Str::limit($inspection->remarks ?? 'Tiada remarks', 100) }}
                                </div>
                            </td>
                            <td>
                                <span class="status {{ strtolower(str_replace(' ', '-', $inspection->status ?? 'pending')) }}">
                                    {{ ucfirst($inspection->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                @if($inspection->attachments->count() > 0)
                                    <span class="attachment-count">{{ $inspection->attachments->count() }}</span>
                                @else
                                    <span style="color: #bdc3c7;">0</span>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- Page break every 15 records -->
                        @if(($index + 1) % 15 == 0 && !$loop->last)
                            </tbody>
                            </table>
                            <div class="page-break"></div>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th style="width: 15%;">Nama Inspector</th>
                                        <th style="width: 10%;">Tarikh</th>
                                        <th style="width: 8%;">Masa</th>
                                        <th style="width: 15%;">Tempat</th>
                                        <th style="width: 12%;">Tempat Sub</th>
                                        <th style="width: 20%;">Remarks</th>
                                        <th style="width: 8%;">Status</th>
                                        <th style="width: 7%;">Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <h3>Tiada Data Inspection</h3>
                <p>Belum ada rekod inspection yang tersedia untuk dipaparkan.</p>
            </div>
        @endif
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Sistem E-Inspection</strong> | 
            Laporan dijana pada {{ date('d/m/Y H:i:s') }} | 
            Halaman ini mengandungi maklumat sulit
        </p>
    </div>
</body>
</html>