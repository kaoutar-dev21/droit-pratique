<style>
    .ap-form{background:#fff;border:1px solid #e4e8ef;border-radius:12px;padding:1.5rem;max-width:640px}
    .ap-field{margin-bottom:1.1rem}
    .ap-field label{display:block;font-weight:600;margin-bottom:.35rem;color:#0a1f44}
    .ap-field input[type=text],.ap-field textarea{width:100%;padding:.7rem .85rem;border:1px solid #d8dde6;border-radius:8px;font:inherit;background:#fff;box-sizing:border-box}
    .ap-field input:focus,.ap-field textarea:focus{outline:2px solid #c9a227;border-color:#c9a227}
    .ap-hint{font-size:.82rem;color:#5a6577;margin-top:.3rem}
    .ap-err{color:#b3261e;font-size:.85rem;margin-top:.3rem}
    .ap-form-actions{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1.4rem}
    .ap-btn{display:inline-block;padding:.65rem 1.2rem;border-radius:8px;border:0;font:inherit;font-weight:600;cursor:pointer;text-decoration:none;background:#0a1f44;color:#fff}
    .ap-btn-gold{background:#c9a227;color:#0a1f44}
    .ap-btn-light{background:#eef1f6;color:#0a1f44}
</style>

<div class="ap-field">
    <label for="name">Nom du domaine</label>
    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" maxlength="80" required>
    @error('name') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field">
    <label for="icon">Icône (emoji)</label>
    <input type="text" id="icon" name="icon" value="{{ old('icon', $category->icon) }}" maxlength="10" placeholder="⚖️">
    <div class="ap-hint">Un emoji, par exemple 👨‍👩‍👧 ou 💼.</div>
    @error('icon') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4" maxlength="300">{{ old('description', $category->description) }}</textarea>
    @error('description') <div class="ap-err">{{ $message }}</div> @enderror
</div>

<div class="ap-form-actions">
    <button type="submit" class="ap-btn ap-btn-gold">{{ $submit }}</button>
    <a href="{{ route('admin.categories.index') }}" class="ap-btn ap-btn-light">Annuler</a>
</div>