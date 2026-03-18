<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Blog::published()
            ->with(['author', 'categories', 'tags'])
            ->latest('created_at');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('pages.general.blog.index', [
            'posts' => $posts,
            'search' => $search,
        ]);
    }

    public function show(string $slug): View
    {
        $post = Blog::published()
            ->where('slug', $slug)
            ->with(['author', 'categories', 'tags'])
            ->firstOrFail();

        $post->incrementViews();

        $related = Blog::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', fn ($q) => $q->whereIn('blog_categories.id', $post->categories->pluck('id')))
            ->with(['author', 'categories'])
            ->latest('created_at')
            ->limit(3)
            ->get();

        if ($related->isEmpty()) {
            $related = Blog::published()
                ->where('id', '!=', $post->id)
                ->with(['author', 'categories'])
                ->latest('created_at')
                ->limit(3)
                ->get();
        }

        return view('pages.general.blog.show', [
            'post' => $post,
            'related' => $related,
        ]);
    }

    public function category(string $slug): View
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $posts = Blog::published()
            ->whereHas('categories', fn ($q) => $q->where('blog_categories.slug', $slug))
            ->with(['author', 'categories', 'tags'])
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('pages.general.blog.index', [
            'posts' => $posts,
            'filterLabel' => 'Kategori: '.$category->name,
            'search' => null,
        ]);
    }

    public function tag(string $slug): View
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();

        $posts = Blog::published()
            ->whereHas('tags', fn ($q) => $q->where('blog_tags.slug', $slug))
            ->with(['author', 'categories', 'tags'])
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('pages.general.blog.index', [
            'posts' => $posts,
            'filterLabel' => 'Tag: #'.$tag->name,
            'search' => null,
        ]);
    }
}
