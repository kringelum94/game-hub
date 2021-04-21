<div class="mt-12" wire:init="loadSimilarGames">
    <h2 class="text-2xl font-bold text-gray-800">Similar games</h2>
    <div class="grid grid-cols-4 gap-8 mt-8">
        @forelse ($games as $game)
        <x-game-card :game="$game" />
        @empty
        <p class="text-gray-800 font-semibold">No similar games could be found</p>
        @endforelse
    </div>
</div>
