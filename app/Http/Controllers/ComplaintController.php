<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $categories = ComplaintCategory::orderBy('nama')->get();

        return view('complaints.index', compact('complaints', 'categories'));
    }

    public function create(): View
    {
        $categories = ComplaintCategory::orderBy('nama')->get();

        return view('complaints.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'complaint_category_id' => 'required|exists:complaint_categories,id',
            'nama_pelapor' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('complaints', 'public');
        }

        Complaint::create($validated);

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dibuat.');
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load(['category', 'responses.user']);

        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint): View
    {
        $categories = ComplaintCategory::orderBy('nama')->get();

        return view('complaints.edit', compact('complaint', 'categories'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'complaint_category_id' => 'required|exists:complaint_categories,id',
            'nama_pelapor' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:baru,diproses,selesai,ditolak',
        ]);

        if ($request->hasFile('foto')) {
            if ($complaint->foto) {
                Storage::disk('public')->delete($complaint->foto);
            }
            $validated['foto'] = $request->file('foto')->store('complaints', 'public');
        }

        $complaint->update($validated);

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        if ($complaint->foto) {
            Storage::disk('public')->delete($complaint->foto);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function updateStatus(Complaint $complaint): RedirectResponse
    {
        $request = request();
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai,ditolak',
        ]);

        $complaint->update(['status' => $request->status]);

        return redirect()->route('complaints.show', $complaint)->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
