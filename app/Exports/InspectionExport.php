<?php

namespace App\Exports;

use App\Models\Inspection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InspectionExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inspection::with(['user.jabatan', 'attachments'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Pengguna',
            'Email Pengguna',
            'Telefon Pengguna',
            'Jabatan',
            'Tarikh',
            'Masa',
            'Tempat',
            'Tempat Sub',
            'Remarks',
            'Status',
            'Jumlah Lampiran',
            'Nama Fail Lampiran',
            'Tarikh Dibuat',
            'Tarikh Dikemaskini'
        ];
    }

    /**
     * @param mixed $inspection
     * @return array
     */
    public function map($inspection): array
    {
        // Kumpulkan nama fail lampiran
        $attachmentFiles = $inspection->attachments->pluck('file')->implode(', ');
        
        return [
            $inspection->id,
            $inspection->user->name ?? 'N/A',
            $inspection->user->email ?? 'N/A',
            $inspection->user->phone ?? 'N/A',
            $inspection->user->jabatan->name ?? 'N/A',
            $inspection->tarikh,
            $inspection->masa,
            $inspection->tempat,
            $inspection->tempat_sub,
            $inspection->remarks,
            $inspection->status,
            $inspection->attachments->count(),
            $attachmentFiles ?: 'Tiada lampiran',
            $inspection->created_at->format('Y-m-d H:i:s'),
            $inspection->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
