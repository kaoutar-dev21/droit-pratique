@extends('layouts.app')

@section('title', $article->title)
@section('description', \Illuminate\Support\Str::limit($article->summary, 150))

@section('content')
<section class="page-header page-header-sm">
    <div class="container">
        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <a href="{{ route('home') }}">Accueil</a> <span>/</span>
            <a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a> <span>/</span>
            <span>{{ \Illuminate\Support\Str::limit($article->title, 50) }}</span>
        </nav>
    </div>
</section>

<div class="container article-layout">
    <article class="article-main">
        <a href="{{ route('categories.show', $article->category->slug) }}" class="badge">{{ $article->category->icon }} {{ $article->category->name }}</a>
        @unless($article->is_published)
            <span class="badge badge-warning">Brouillon (visible par les admins)</span>
        @endunless

        <h1 class="article-title">{{ $article->title }}</h1>

        <div class="meta meta-lg">
            <span>Par <strong>{{ $article->user->name }}</strong></span>
            <span>·</span>
            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
            <span>·</span>
            <span>{{ $article->reading_time }} min de lecture</span>
            <span>·</span>
            <span>{{ $article->views }} vues</span>
        </div>

        <p class="article-summary">{{ $article->summary }}</p>

        <div class="prose">
            {!! $article->formatted_content !!}
        </div>

        <div class="disclaimer">
            <strong>À noter :</strong> cet article est fourni à titre informatif et ne constitue pas un conseil juridique personnalisé. Pour votre situation, consultez un avocat ou un professionnel du droit.
        </div>

        <section id="commentaires" class="comments">
            <h2>Commentaires <span class="count">{{ $article->comments->count() }}</span></h2>

            @auth
                <form method="POST" action="{{ route('comments.store', $article->slug) }}" class="comment-form">
                    @csrf
                    <label for="body" class="sr-only">Votre commentaire</label>
                    <textarea id="body" name="body" rows="4" maxlength="1000" placeholder="Partagez votre avis ou posez votre question..." data-counter="#bodyCounter" required>{{ old('body') }}</textarea>
                    <div class="comment-form-footer">
                        <span class="counter" id="bodyCounter">0 / 1000</span>
                        <button type="submit" class="btn btn-primary">Publier le commentaire</button>
                    </div>
                    @error('body')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </form>
            @else
                <div class="login-prompt">
                    <p>Connectez-vous pour participer à la discussion.</p>
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Connexion</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">Créer un compte</a>
                    </div>
                </div>
            @endauth

            @forelse($article->comments as $comment)
                <div class="comment" id="commentaire-{{ $comment->id }}">
                    <div class="avatar avatar-lg">{{ $comment->user->initials }}</div>
                    <div class="comment-body">
                        <div class="comment-head">
                            <strong>{{ $comment->user->name }}</strong>
                            @if($comment->user->isAdmin())
                                <span class="badge badge-gold">Admin</span>
                            @endif
                            <time datetime="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->diffForHumans() }}</time>
                        </div>
                        <p>{!! nl2br(e($comment->body)) !!}</p>

                        @auth
                            @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" data-confirm="Supprimer ce commentaire ?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="link-danger">Supprimer</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <p class="empty">Aucun commentaire pour le moment. Soyez le premier à réagir !</p>
            @endforelse
        </section>
    </article>

    <aside class="article-side">
        @if($related->isNotEmpty())
            <div class="side-box">
                <h3>Articles similaires</h3>
                <ul class="side-list">
                    @foreach($related as $item)
                        <li>
                            <a href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                            <small>{{ $item->created_at->translatedFormat('d M Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="side-box">
            <h3>Domaines</h3>
            <ul class="side-list side-list-plain">
                @foreach($categories as $cat)
                    <li><a href="{{ route('categories.show', $cat->slug) }}">{{ $cat->icon }} {{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
@endsection