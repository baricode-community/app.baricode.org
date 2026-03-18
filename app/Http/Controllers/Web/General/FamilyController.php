<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');

        $members = User::query()
            ->select(['name', 'username', 'bio', 'created_at'])
            ->when($search, fn ($q) => $q->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            }))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('pages.general.family.index', compact('members', 'search'));
    }

    public function show(User $user)
    {
        $user->load(['meme', 'dailyCommitTrackers', 'meets']);

        return view('pages.general.family.show', compact('user'));
    }
}
