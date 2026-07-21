<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $stats = $this->getStats();
        $recentComplaints = $this->getRecentComplaints();
        $recentResponses = $this->getRecentResponses();
        $monthlyData = $this->getMonthlyData();
        $statusData = $this->getStatusData();
        $topCategories = $this->getTopCategories();

        return view('dashboard', compact(
            'stats',
            'recentComplaints',
            'recentResponses',
            'monthlyData',
            'statusData',
            'topCategories'
        ));
    }

    private function getStats(): array
    {
        $today = Carbon::today();

        return [
            'total' => Complaint::count(),
            'baru' => Complaint::where('status', 'baru')->count(),
            'diproses' => Complaint::where('status', 'diproses')->count(),
            'selesai' => Complaint::where('status', 'selesai')->count(),
            'ditolak' => Complaint::where('status', 'ditolak')->count(),
            'today' => Complaint::whereDate('created_at', $today)->count(),
        ];
    }

    private function getRecentComplaints()
    {
        return Complaint::with('category')
            ->latest()
            ->take(10)
            ->get();
    }

    private function getRecentResponses()
    {
        return Response::with(['complaint', 'user'])
            ->latest()
            ->take(10)
            ->get();
    }

    private function getMonthlyData(): array
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push([
                'month' => $date->format('M Y'),
                'count' => Complaint::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ]);
        }

        return $months->toArray();
    }

    private function getStatusData(): array
    {
        return Complaint::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
    }

    private function getTopCategories(): array
    {
        return ComplaintCategory::withCount('complaints')
            ->orderByDesc('complaints_count')
            ->take(5)
            ->get()
            ->toArray();
    }
}
