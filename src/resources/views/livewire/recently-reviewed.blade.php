<div wire:init="load" class="space-y-12 mt-8">
    @forelse ($recentlyReviewedGames as $game)
    <a href="/games/{{ $game['slug'] }}" class="block">
        <div
            class="bg-gray-800 rounded-lg overflow-hidden shadow-md flex transition duration-200 ease-in-out transform hover:translate-x-2 pr-6 flex-row">
            @if ($game['rating'])
            <div class="hidden absolute z-10 top-0 right-0 mr-6 mt-6 sm:block">
                <x-rating-circle-big :gameRating="$game['rating']">
                </x-rating-circle-big>
            </div>
            @endif
            <div class="relative flex-shrink-0">
                <img class="object-cover w-32 h-full sm:w-48 sm:h-full" src="{{ $game['cover_big'] }}" alt="cover-art">
            </div>
            <div class="ml-4 mt-8 sm:ml-12 sm:my-8">
                <div class="text-lg font-bold text-gray-100">{{ $game['name'] }}</div>
                <div class="text-gray-100 mt-1 font-semibold">
                    {{ $game['platforms'] }}
                </div>
                <p class="hidden text-sm mt-6 text-gray-200 sm:block">
                    {{$game['summary']}}
                </p>
            </div>
        </div>
    </a>
    @empty
    @foreach (range(1, 3) as $game)
    <div
        class="animate-pulse bg-gray-800 rounded-lg overflow-hidden shadow-md flex transition duration-200 ease-in-out transform sm:pr-6 flex-row">
        <div class="relative flex-shrink-0">
            <div class="w-32 h-40 sm:w-48 sm:h-full bg-gray-700"></div>
        </div>
        <div class="ml-4 my-4 sm:ml-12 sm:my-8">
            <div class="pr-4">
                <div class="text-lg font-bold text-transparent rounded inline-block bg-gray-700">Title of the game</div>
            </div>
            <div class="text-transparent text-lg rounded inline-block bg-gray-700 mt-3">
                PS4, PC, Xbox
            </div>
            <p class="hidden text-base rounded mt-6 text-transparent bg-gray-700 sm:block">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.
            </p>
            <p class="hidden text-base rounded mt-3 text-transparent bg-gray-700 sm:block">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.
            </p>
            <p class="hidden text-base rounded mt-3 text-transparent bg-gray-700 sm:block">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.
            </p>
        </div>
    </div>
    @endforeach
    @endforelse
</div>
