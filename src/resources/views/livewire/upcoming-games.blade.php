<div wire:init="load" class="space-y-8 mt-8">
    @forelse ($upcomingGames as $game)
    <x-game-card-small :game="$game" />
    @empty
    @foreach (range(1, 3) as $game)
    <x-game-card-small-skeleton />
    @endforeach
    @endforelse
</div>
