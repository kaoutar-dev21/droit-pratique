@extends('layouts.admin')

@section('title', 'Nouvel article')

@section('content')
<form method="POST" action="{{ route('admin.articles.store') }}" class="ap-form">
    @csrf
    @include('admin.articles._form', ['submit' => 'Créer l\'article'])
</form>
@endsection