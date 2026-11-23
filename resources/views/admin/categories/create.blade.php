@extends('layouts.admin')

@section('title', 'Nouveau domaine')

@section('content')
<form method="POST" action="{{ route('admin.categories.store') }}" class="ap-form">
    @csrf
    @include('admin.categories._form', ['submit' => 'Créer le domaine'])
</form>
@endsection