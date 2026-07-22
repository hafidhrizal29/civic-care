<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResponseController extends Controller
{
    public function index(Request $request): View
    {
        $responses = Response::with(['complaint', 'user'])
            ->search($request->search)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('responses.index', compact('responses'));
    }

    public function create(): View
    {
        $complaints = Complaint::whereNotIn('status', ['selesai', 'ditolak'])
            ->with('category')
            ->latest()
            ->get();

        return view('responses.create', compact('complaints'));
    }

    public function store(Request $request): RedirectResponse
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

    public function edit(Response $response): View
    {
        $complaints = Complaint::whereNotIn('status', ['selesai', 'ditolak'])
            ->with('category')
            ->latest()
            ->get();

        return view('responses.edit', compact('response', 'complaints'));
    }

    public function update(Request $request, Response $response): RedirectResponse
    {
        $validated = $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'isi' => 'required|string',
        ]);

        $response->update($validated);

        return redirect()->route('responses.index')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function destroy(Response $response): RedirectResponse
    {
        $response->delete();

        return redirect()->route('responses.index')->with('success', 'Tanggapan berhasil dihapus.');
    }
}
