<article class="card article-card">
    <a href="{{ route('articles.show', $article->slug) }}" class="card-link">
        <div class="card-top">
            <span class="badge">{{ $article->category->icon }} {{ $article->category->name }}</span>
            @unless($article->is_published)
                <span class="badge badge-warning">Brouillon</span>
            @endunless
        </div>
        <h3>{{ $article->title }}</h3>
        <p>{{ \Illuminate\Support\Str::limit($article->summary, 130) }}</p>
        <div class="meta">
            <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
            <span>·</span>
            <span>{{ $article->reading_time }} min de lecture</span>
            @isset($article->comments_count)
                <span>·</span>
                <span>{{ $article->comments_count }} 💬</span>
            @endisset
        </div>
    </a>
</article>