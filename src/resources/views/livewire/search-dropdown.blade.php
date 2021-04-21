<div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
    <div class="flex items-center mt-6 lg:mt-0">
        <input
            class="transition duration-500 ease-in-out text-sm text-gray-800 py-1 pl-8 pr-3 w-64 sm:w-88 bg-gray-100 rounded placeholder-gray-800 font-semibold hover:bg-white focus:outline-none focus:shadow-outline"
            placeholder="Search..." type="text" wire:model.debounce="search" @focus="isVisible = true"
            @keydown.escape.window="isVisible = false" @keydown="isVisible = true">
        <svg viewBox="0 0 20 20" fill="currentColor" class="search w-4 h-4 ml-2 text-gray-800 absolute left-0">
            <path fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"></path>
        </svg>
        <div wire:loading class="absolute right-0 mr-2 animate-spin rounded-full border-t-2 border-gray-800 h-4 w-4">
        </div>
    </div>
    <div class="absolute z-50 overflow-hidden bg-gray-700 shadow text-sm font-semibold text-gray-100 rounded w-64 sm:w-88 mt-2"
        x-show.transition="isVisible">
        <ul class="divide-y divide-gray-600">
            @if(strlen($search) >= 2)
            @forelse($results as $game)
            <li>
                <a href="/games/{{ $game['slug'] }}"
                    class="px-3 py-3 flex items-center transition ease-in-out duration-150 hover:bg-gray-600">
                    @if(isset($game['cover']))
                    <img class="w-10 h-12 rounded object-cover" src="{{ $game['cover-image'] }}" alt="cover">
                    @else
                    <span class="w-10 h-12"></span>
                    @endif
                    <span class="ml-4">{{ $game['name'] }}</span>
                </a>
            </li>
            @empty
            <div class="px-3 py-3">
                Sorry, no result found... 😭
            </div>
            @endforelse
            @endif
        </ul>
    </div>
</div>
