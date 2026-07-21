<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResponseController extends Controller
{
    public function index(Request $request): View
    {
        $responses = Response::with(['complaint', 'user'])
            ->latest()
            ->paginate(15);

        return view('responses.index', compact('responses'));
    }

    public function create(): View
    {
        $complaints = Complaint::where('status', '!=', 'selesai')
            ->where('status', '!=', 'ditolak')
            ->latest()
            ->get();

        return view('responses.create', compact('complaints'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'isi' => 'required|string',
        ]);

        Response::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('responses.index')->with('success', 'Tanggapan berhasil dikirim.');
    }
}
