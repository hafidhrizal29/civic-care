<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;

class LandingController extends Controller
{
    public function index()
    {
        $categories = ComplaintCategory::withCount('complaints')->get();

        $totalComplaints = Complaint::count();
        $processedComplaints = Complaint::where('status', 'diproses')->count();
        $completedComplaints = Complaint::where('status', 'selesai')->count();
        $totalCategories = ComplaintCategory::count();

        return view('welcome', compact(
            'categories',
            'totalComplaints',
            'processedComplaints',
            'completedComplaints',
            'totalCategories',
        ));
    }
}
