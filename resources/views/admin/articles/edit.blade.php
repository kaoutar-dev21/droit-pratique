@extends('layouts.admin')

@section('title', 'Modifier l\'article')

@section('content')
<form method="POST" action="{{ route('admin.articles.update', $article) }}" class="ap-form">
    @csrf
    @method('PUT')
    @include('admin.articles._form', ['submit' => 'Enregistrer les modifications'])
</form>
@endsection