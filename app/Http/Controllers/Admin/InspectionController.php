<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.inspections.template-index', [
            'inspections' => $inspections
        ]);
    }

    public function show($id)
    {
        $inspection = Inspection::with(['user', 'attachments'])->findOrFail($id);
        
        return view('admin.inspections.template-show', [
            'inspection' => $inspection
        ]);
    }

    public function destroy($id)
    {
        try {
            $inspection = Inspection::findOrFail($id);
            
            // Hapus semua attachments terkait
            $inspection->attachments()->delete();
            
            // Hapus inspection
            $inspection->delete();
            
            return redirect()->route('admin.inspections.index')
                ->with('success', 'Inspeksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.inspections.index')
                ->with('error', 'Gagal menghapus inspeksi: ' . $e->getMessage());
        }
    }
}
