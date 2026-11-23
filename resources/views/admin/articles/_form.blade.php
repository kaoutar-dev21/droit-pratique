<style>
    .ap-form{background:#fff;border:1px solid #e4e8ef;border-radius:12px;padding:1.5rem;max-width:860px}
    .ap-field{margin-bottom:1.1rem}
    .ap-field label{display:block;font-weight:600;margin-bottom:.35rem;color:#0a1f44}
    .ap-field input[type=text],.ap-field select,.ap-field textarea{width:100%;padding:.7rem .85rem;border:1px solid #d8dde6;border-radius:8px;font:inherit;background:#fff;box-sizing:border-box}
    .ap-field textarea{resize:vertical;line-height:1.55}
    .ap-field input:focus,.ap-field select:focus,.ap-field textarea:focus{outline:2px solid #c9a227;border-color:#c9a227}
    .ap-hint{font-size:.82rem;color:#5a6577;margin-top:.3rem}
    .ap-err{color:#b3261e;font-size:.85rem;margin-top:.3rem}
    .ap-check{display:flex;align-items:center;gap:.5rem}
    .ap-check label{margin:0}
    .ap-form-actions{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1.4rem}
    .ap-btn{display:inline-block;padding:.65rem 1.2rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-gold{background:#c9a227;color:#0a1f44}
    .ap-btn-light{background:#eef1f6;color:#0a1f44}
</style>

<div class="ap-field">
    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" maxlength="180" required>
    @error('title') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field">
    <label for="category_id">Domaine</label>
    <select id="category_id" name="category_id" required>
        <option value="">-- Choisir un domaine --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected((string) old('category_id', $article->category_id) === (string) $category->id)>
                {{ $category->icon }} {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field">
    <label for="summary">Résumé</label>
    <textarea id="summary" name="summary" rows="3" maxlength="400" required>{{ old('summary', $article->summary) }}</textarea>
    <div class="ap-hint">Entre 20 et 400 caractères.</div>
    @error('summary') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field">
    <label for="content">Contenu</label>
    <textarea id="content" name="content" rows="14" required>{{ old('content', $article->content) }}</textarea>
    <div class="ap-hint">Utilisez « ## Titre » pour un intertitre et « - » pour une liste. Une ligne vide sépare les paragraphes.</div>
    @error('content') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field ap-check">
    <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $article->exists ? $article->is_published : true))>
    <label for="is_published">Publier cet article</label>
</div>

<div class="ap-form-actions">
    <button type="submit" class="ap-btn ap-btn-gold">{{ $submit }}</button>
    <a href="{{ route('admin.articles.index') }}" class="ap-btn ap-btn-light">Annuler</a>
</div>