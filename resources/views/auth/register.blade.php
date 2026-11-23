@extends('layouts.app')

@section('title', 'Créer un compte')

@section('content')
<section class="auth-page">
    <div class="auth-card">
        <h1>Créer un compte</h1>
        <p class="sub">Rejoignez la communauté pour commenter et poser vos questions.</p>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus autocomplete="name">
                @error('name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autocomplete="email">
                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                <small style="color:#667085">Au moins 8 caractères, avec des lettres et des chiffres.</small>
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">Créer mon compte</button>
        </form>

        <p class="auth-alt">Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
    </div>
</section>
@endsection