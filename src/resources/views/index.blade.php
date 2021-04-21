@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 flex-shrink-0 mr-8 sm:text-4xl">New and exciting 🤩</h1>
        <div class="border-b-2 border-teal-400 w-full self-center"></div>
    </div>
    <livewire:popular-games>
        <div class="flex flex-col my-10 lg:flex-row">
            <div class="w-full lg:w-3/4 lg:mr-16 xl:mr-32">
                <h2 class="text-3xl font-bold text-gray-800">Hot off the press 🔥</h2>
                <livewire:recently-reviewed>
            </div>
            <div class="w-full flex flex-col mt-8 lg:w-1/4 lg:mt-0">
                <h2 class="text-3xl font-bold text-gray-800">Upcoming ⏱️</h2>
                <livewire:upcoming-games>
                    <h2 class="text-3xl font-bold text-gray-800 mt-12">The best 🏆</h2>
                    <livewire:top-games>
            </div>
        </div>
</div>
@endsection
