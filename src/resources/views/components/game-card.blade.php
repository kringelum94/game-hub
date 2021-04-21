<div
    class="transition duration-200 ease-in-out transform col-span-4 h-64 relative overflow-hidden rounded-lg shadow-md hover:scale-105 sm:col-span-2 lg:col-span-1">
    <a href="/games/{{ $game['slug'] }}">
        @if ($game['rating'])
        <div class="absolute top-0 right-0 mr-4 mt-4">
            <x-rating-circle-small :gameRating="$game['rating']"></x-rating-circle-small>
        </div>
        @endif
        <div
            class="absolute bg-gray-800 bottom-0 w-full flex justify-around py-1 px-3 items-baseline border-t-2 border-teal-400">
            <span class="text-gray-100 font-bold text-lg">
                {{ $game['name'] }}
            </span>
        </div>
        <img class="w-full h-full object-cover" src="{{ $game['cover-image'] }}" alt="cover-art">
    </a>
</div>
