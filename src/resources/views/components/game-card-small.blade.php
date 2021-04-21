<div class="flex">
    <a class="flex-shrink-0" href="/games/{{ $game['slug'] }}">
        <img class="transition duration-200 ease-in-out rounded w-16 h-20 object-cover transform hover:-translate-y-1"
            src="{{ $game['cover_small'] }}" alt="cover-art">
    </a>
    <div class="ml-4">
        <a href="/games/{{ $game['slug'] }}"
            class="transition duration-200 ease-in-out font-bold text-gray-800 hover:text-teal-700">{{ $game['name'] }}</a>
        <div class="text-gray-800 font-semibold">
            {{ $game['release_date'] }}</div>
    </div>
</div>
