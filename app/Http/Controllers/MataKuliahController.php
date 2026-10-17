<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mataKuliahs = MataKuliah::latest()->get();

        return view('mata-kuliah.index', compact('mataKuliahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mata-kuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:mata_kuliahs,kode'],
            'nama' => ['required', 'string', 'max:100'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
        ]);

        $validated['aktif'] = $request->has('aktif') ? $request->boolean('aktif') : true;

        MataKuliah::create($validated);

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah): View
    {
        return view('mata-kuliah.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah): View
    {
        return view('mata-kuliah.edit', compact('mataKuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mata_kuliahs', 'kode')->ignore($mataKuliah->id),
            ],
            'nama' => ['required', 'string', 'max:100'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
        ]);

        $validated['aktif'] = $request->boolean('aktif');

        $mataKuliah->update($validated);

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->delete();

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
