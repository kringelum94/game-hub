<div wire:init="load">
    <div class="grid grid-cols-4 gap-8 mb-8">
        @forelse ($mostPopularGames as $game)
        <div
            class="transition duration-200 ease-in-out transform col-span-4 relative overflow-hidden rounded-lg shadow-md hover:scale-105 lg:col-span-2">
            <a href="/games/{{ $game['slug'] }}">
                @if ($game['rating'])
                <div class="absolute top-0 right-0 mr-5 mt-5">
                    <x-rating-circle-big :gameRating="$game['rating']"></x-rating-circle-big>
                </div>
                @endif
                <div
                    class="absolute bg-gray-800 bottom-0 w-full flex justify-center py-1 px-3 md:pb-2 items-baseline border-t-4 border-teal-400">
                    <span class="text-gray-100 font-bold text-lg md:text-2xl">
                        {{ $game['name'] }}
                    </span>
                </div>
                <img src="{{ $game['cover-image'] }}" class="h-64 w-full md:h-85 object-cover" alt="cover-art">
            </a>
        </div>
        @empty
        @foreach (range(1, 2) as $game)
        <div
            class="animate-pulse transition duration-200 relative ease-in-out col-span-4 overflow-hidden rounded-lg shadow-md lg:col-span-2">
            <div class="absolute bg-gray-700 bottom-0 w-full h-10 flex"></div>
            <div class="w-full h-64 md:h-85 bg-gray-800"></div>
        </div>
        @endforeach
        @endforelse
    </div>

    <div class="grid grid-cols-4 gap-8">
        @forelse ($popularGames as $game)
        <x-game-card :game="$game" />
        @empty
        @foreach (range(1, 4) as $game)
        <x-game-card-skeleton />
        @endforeach
        @endforelse
    </div>
</div>
