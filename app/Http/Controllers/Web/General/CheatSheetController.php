<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\CheatSheet;
use App\Models\CheatSheetCategory;
use Illuminate\Http\Request;

class CheatSheetController extends Controller
{
    public function index()
    {
        return view('pages.general.cheatsheet.index');
    }

    public function show(CheatSheet $cheatSheet)
    {
        if (! $cheatSheet->is_public && $cheatSheet->user_id !== auth()->id()) {
            abort(403);
        }

        $cheatSheet->load(['user:id,name,username', 'category']);

        return view('pages.general.cheatsheet.show', compact('cheatSheet'));
    }

    public function create()
    {
        $categories = CheatSheetCategory::orderBy('name')->get();

        return view('pages.general.cheatsheet.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'cheat_sheet_category_id' => 'required|exists:cheat_sheet_categories,id',
            'is_public' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_public'] = $request->boolean('is_public');

        $sheet = CheatSheet::create($validated);

        return redirect()->route('cheatsheet.show', $sheet->id)
            ->with('success', 'Cheat sheet berhasil dibuat!');
    }

    public function edit(CheatSheet $cheatSheet)
    {
        abort_if($cheatSheet->user_id !== auth()->id(), 403);

        $categories = CheatSheetCategory::orderBy('name')->get();

        return view('pages.general.cheatsheet.edit', compact('cheatSheet', 'categories'));
    }

    public function update(Request $request, CheatSheet $cheatSheet)
    {
        abort_if($cheatSheet->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'cheat_sheet_category_id' => 'required|exists:cheat_sheet_categories,id',
            'is_public' => 'boolean',
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        $cheatSheet->update($validated);

        return redirect()->route('cheatsheet.show', $cheatSheet->id)
            ->with('success', 'Cheat sheet berhasil diperbarui!');
    }

    public function destroy(CheatSheet $cheatSheet)
    {
        abort_if($cheatSheet->user_id !== auth()->id(), 403);

        $cheatSheet->delete();

        return redirect()->route('cheatsheet.index')
            ->with('success', 'Cheat sheet berhasil dihapus.');
    }
}
