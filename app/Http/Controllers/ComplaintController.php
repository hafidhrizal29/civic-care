<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $complaints = Complaint::with('category')
            ->search($request->search)
            ->status($request->status)
            ->category($request->category)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load(['category', 'responses.user']);

        return view('complaints.show', compact('complaint'));
    }
}
