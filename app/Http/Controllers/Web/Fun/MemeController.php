<?php

namespace App\Http\Controllers\Web\Fun;

use App\Http\Controllers\Controller;
use App\Models\Fun\Meme;
use App\Models\User;

class MemeController extends Controller
{
    public function index()
    {
        return view('pages.fun.meme.index');
    }

    public function create()
    {
        return view('pages.fun.meme.create');
    }

    public function user_list()
    {
        $usersData = User::whereHas('meme')
            ->get()
            ->map(function ($user) {
                $memes = Meme::where('user_id', $user->id)->get();
                $totalMemes = $memes->count();
                $totalUpvotes = $memes->sum(function ($meme) {
                    return $meme->upvotesCount();
                });
                $totalDownvotes = $memes->sum(function ($meme) {
                    return $meme->downvotesCount();
                });
                $totalVotes = $totalUpvotes + $totalDownvotes;

                return [
                    'user' => $user,
                    'totalMemes' => $totalMemes,
                    'totalUpvotes' => $totalUpvotes,
                    'totalDownvotes' => $totalDownvotes,
                    'totalVotes' => $totalVotes,
                ];
            })
            ->sortByDesc('totalVotes')
            ->values();

        return view('pages.fun.meme.user_list', ['users' => $usersData]);
    }

    public function user(User $user)
    {
        // Get user's meme statistics
        $memes = $user->meme()->exists() ? Meme::where('user_id', $user->id)->get() : collect();
        $totalMemes = $memes->count();
        $totalUpvotes = $memes->sum(function ($meme) {
            return $meme->upvotesCount();
        });
        $totalDownvotes = $memes->sum(function ($meme) {
            return $meme->downvotesCount();
        });
        $totalVotes = $totalUpvotes + $totalDownvotes;
        $averageVotes = $totalMemes > 0 ? round($totalVotes / $totalMemes, 2) : 0;

        return view('pages.fun.meme.user', [
            'user' => $user,
            'memes' => $memes,
            'totalMemes' => $totalMemes,
            'totalUpvotes' => $totalUpvotes,
            'totalDownvotes' => $totalDownvotes,
            'totalVotes' => $totalVotes,
            'averageVotes' => $averageVotes,
        ]);
    }

    public function show(Meme $meme)
    {
        return view('pages.fun.meme.show', ['meme' => $meme]);
    }
}
