<x-layouts.blog :title="$post->effective_title">
    @php
        $metaDescription = $post->effective_description;
    @endphp

    @push('head')
        @if($metaDescription)
            <meta name="description" content="{{ $metaDescription }}">
            <meta property="og:description" content="{{ $metaDescription }}">
        @endif
        <meta property="og:title" content="{{ $post->effective_title }}">
        <meta property="og:type" content="article">
        @if($post->featured_image)
            <meta property="og:image" content="{{ Storage::url($post->featured_image) }}">
        @endif
    @endpush

    <!-- Hero Header -->
    <div style="padding: 3rem 0; background: linear-gradient(135deg, #2563eb 0%, #1e40af 50%, #1e3a8a 100%); color: white; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1;">
            <svg style="width: 100%; height: 100%;" viewBox="0 0 1000 500" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-detail" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="1000" height="500" fill="url(#grid-detail)" />
            </svg>
        </div>
        <div class="blog-container" style="position: relative; z-index: 1;">
            <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: rgba(255,255,255,0.9); text-decoration: none; font-weight: 500; padding: 0.5rem 1rem; border-radius: 8px; background: rgba(255,255,255,0.1); transition: all 0.3s ease; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.2);">
                <span>←</span> Kembali ke Blog
            </a>
            <h1 style="font-size: 2.8rem; font-weight: 700; margin: 1rem 0 0 0; line-height: 1.3;">
                {{ $post->title }}
            </h1>
        </div>
    </div>

    <div class="blog-container" style="margin-top: -2rem; margin-bottom: 3rem;">
        <!-- Article -->
        <article class="blog-article" style="border-radius: 15px; overflow: hidden;">
            <!-- Featured image -->
            {{-- @if ($post->featured_image)
                <div style="width: 100%; height: 450px; overflow: hidden; position: relative;">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
            @endif --}}

            <!-- Article content -->
            <div class="blog-article-body">
                <!-- Category Badges -->
                @if ($post->categories->count() > 0)
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                        @foreach ($post->categories as $category)
                            <a href="{{ route('blog.category', $category->slug) }}" class="blog-badge" style="text-decoration: none;">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Meta information -->
                <div class="blog-meta" style="margin-bottom: 2rem;">
                    <div class="blog-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ $post->author->name }}</span>
                    </div>

                    <div class="blog-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ ($post->published_at ?? $post->created_at)->translatedFormat('d F Y H:i') }}</span>
                    </div>

                    <div class="blog-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $post->reading_time }} min read</span>
                    </div>

                    <div class="blog-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $post->word_count }} kata</span>
                    </div>

                    <div class="blog-meta-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>
                </div>

                <!-- Article body -->
                <div class="blog-content" style="margin-bottom: 2rem;">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if ($post->tags->count() > 0)
                    <div style="padding-top: 2rem; border-top: 2px solid rgba(37, 99, 235, 0.2);">
                        <h3 style="color: #f1f5f9; font-weight: 600; margin: 0 0 1rem 0;">🏷️ Tags</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}"
                                    style="display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: #dbeafe; border-radius: 20px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease; text-decoration: none; border: 1px solid #2563eb;"
                                    onmouseover="this.style.background='linear-gradient(135deg, #2563eb 0%, #1e40af 100%)'; this.style.color='white'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(37, 99, 235, 0.3)';"
                                    onmouseout="this.style.background='linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%)'; this.style.color='#dbeafe'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>

        <!-- Related posts -->
        @if ($related->count() > 0)
            <div style="margin-top: 4rem;">
                <h2 style="color: #f1f5f9; font-size: 1.75rem; font-weight: 700; margin-bottom: 1.5rem;">📚 Artikel Terkait</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach ($related as $relatedPost)
                        <article class="blog-article" style="border-radius: 12px; overflow: hidden;">
                            <div style="height: 160px; background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                @if ($relatedPost->featured_image)
                                    <img src="{{ Storage::url($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                @else
                                    <span style="font-size: 2.5rem; opacity: 0.4;">📝</span>
                                @endif
                            </div>
                            <div style="padding: 1.25rem;">
                                @if ($relatedPost->categories->count() > 0)
                                    <a href="{{ route('blog.category', $relatedPost->categories->first()->slug) }}" class="blog-badge" style="font-size: 0.75rem; text-decoration: none;">
                                        {{ $relatedPost->categories->first()->name }}
                                    </a>
                                @endif
                                <h3 style="color: #f1f5f9; font-size: 1.1rem; font-weight: 600; margin: 0.5rem 0; line-height: 1.4;">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" style="color: #f1f5f9; text-decoration: none; transition: color 0.2s;"
                                        onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#f1f5f9'">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">
                                    {{ $relatedPost->author->name }} · {{ $relatedPost->reading_time }} min read
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back to blog link -->
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('blog.index') }}" style="display: inline-block; color: #2563eb; text-decoration: none; font-weight: 600; transition: all 0.3s ease; padding: 0.875rem 2rem; border-radius: 8px; border: 2px solid #2563eb; background: transparent;"
                onmouseover="this.style.background='linear-gradient(135deg, #2563eb 0%, #1e40af 100%)'; this.style.color='white'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 30px rgba(37, 99, 235, 0.3)';"
                onmouseout="this.style.background='transparent'; this.style.color='#2563eb'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                ← Kembali ke Blog
            </a>
        </div>
    </div>
</x-layouts.blog>
