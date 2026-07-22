<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function index(Request $request): View
    {
        $complaint = null;

        if ($request->filled('nomor_tiket')) {
            $complaint = Complaint::with(['category', 'responses.user'])
                ->where('nomor_tiket', $request->nomor_tiket)
                ->first();
        }

        return view('tracking.index', compact('complaint'));
    }
}
