<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\CheatSheet;
use App\Models\CheatSheetCategory;
use Illuminate\Http\Request;

class CheatSheetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $categoryId = $request->get('category');

        $publicSheets = CheatSheet::query()
            ->with(['user:id,name,username', 'category'])
            ->where('is_public', true)
            ->when(auth()->check(), fn ($q) => $q->where('user_id', '!=', auth()->id()))
            ->when($search, fn ($q) => $q->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->when($categoryId, fn ($q) => $q->where('cheat_sheet_category_id', $categoryId))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $mySheets = null;
        if (auth()->check()) {
            $mySheets = CheatSheet::query()
                ->with('category')
                ->where('user_id', auth()->id())
                ->when($search, fn ($q) => $q->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                }))
                ->when($categoryId, fn ($q) => $q->where('cheat_sheet_category_id', $categoryId))
                ->latest()
                ->get();
        }

        $categories = CheatSheetCategory::orderBy('name')->get();

        return view('pages.general.cheatsheet.index', compact('publicSheets', 'mySheets', 'search', 'categoryId', 'categories'));
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
            'title'                    => 'required|string|max:255',
            'description'              => 'nullable|string|max:500',
            'content'                  => 'required|string',
            'cheat_sheet_category_id'  => 'required|exists:cheat_sheet_categories,id',
            'is_public'                => 'boolean',
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
            'title'                    => 'required|string|max:255',
            'description'              => 'nullable|string|max:500',
            'content'                  => 'required|string',
            'cheat_sheet_category_id'  => 'required|exists:cheat_sheet_categories,id',
            'is_public'                => 'boolean',
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
