@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<section class="auth-page">
    <div class="auth-card">
        <h1>Connexion</h1>
        <p class="sub">Accédez à votre compte pour commenter les articles.</p>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus autocomplete="email">
                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <label class="form-check">
                <input type="checkbox" name="remember" value="1"> Se souvenir de moi
            </label>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <p class="auth-alt">Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>

        @if(app()->environment('local'))
            <div class="demo-box">
                <strong>Comptes de démonstration (mode local)</strong><br>
                Utilisateur : user@droitpratique.ma / User@12345<br>
                Admin : admin@droitpratique.ma / Admin@12345
            </div>
        @endif
    </div>
</section>
@endsection