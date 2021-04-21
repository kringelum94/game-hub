@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div>
        <livewire:single-game :slug="$slug">
    </div>
    <div>
        <livewire:similar-games :slug="$slug">
    </div>
</div>
@endsection
