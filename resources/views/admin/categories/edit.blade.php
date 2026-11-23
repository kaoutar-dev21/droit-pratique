@extends('layouts.admin')

@section('title', 'Modifier le domaine')

@section('content')
<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="ap-form">
    @csrf
    @method('PUT')
    @include('admin.categories._form', ['submit' => 'Enregistrer les modifications'])
</form>
@endsection