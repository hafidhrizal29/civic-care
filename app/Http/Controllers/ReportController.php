<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Complaint::with('category');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('category')) {
            $query->where('complaint_category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $total = (clone $query)->count();
        $selesai = (clone $query)->where('status', 'selesai')->count();
        $completionRate = $total > 0 ? round(($selesai / $total) * 100, 1) : 0;

        $completedComplaints = (clone $query)->where('status', 'selesai')->get();
        $avgResolutionDays = $completedComplaints->isNotEmpty()
            ? round($completedComplaints->avg(fn ($c) => $c->created_at->diffInHours($c->updated_at)) / 24, 1)
            : null;

        $topCategoryId = (clone $query)
            ->selectRaw('complaint_category_id, COUNT(*) as total')
            ->groupBy('complaint_category_id')
            ->orderByDesc('total')
            ->value('complaint_category_id');
        $topCategory = $topCategoryId ? ComplaintCategory::find($topCategoryId) : null;

        $complaints = $query->latest()->paginate(15)->withQueryString();

        $categories = ComplaintCategory::orderBy('nama')->get();

        return view('reports.index', compact(
            'complaints', 'categories', 'total', 'selesai', 'completionRate',
            'avgResolutionDays', 'topCategory'
        ));
    }

    public function export(Request $request)
    {
        $query = Complaint::with('category');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('category')) {
            $query->where('complaint_category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $complaints = $query->latest()->get();

        $filename = 'laporan-pengaduan-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($complaints) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Nomor Tiket', 'Judul', 'Kategori', 'Pelapor', 'Email',
                'Telepon', 'Lokasi', 'Status', 'Tanggal Dibuat',
            ]);

            foreach ($complaints as $complaint) {
                fputcsv($handle, [
                    $complaint->nomor_tiket,
                    $complaint->judul,
                    $complaint->category->nama,
                    $complaint->nama_pelapor,
                    $complaint->email ?? '-',
                    $complaint->telepon ?? '-',
                    $complaint->lokasi,
                    $complaint->status_label,
                    $complaint->created_at->format('d M Y H:i'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment',
        ]);
    }
}
