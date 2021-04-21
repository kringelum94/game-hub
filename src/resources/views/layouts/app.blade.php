<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Hub</title>
    <link rel="stylesheet" href="/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee" rel="stylesheet">
    <livewire:styles>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="bg-pattern h-full w-full">
    <header class="bg-gray-800 text-gray-100 border-b-4 border-teal-400">
        <nav class="container mx-auto flex flex-col items-center justify-between px-4 py-6 lg:flex-row">
            <div class="flex flex-col items-center lg:flex-row">
                <a class="transition duration-500 ease-in-out font-display text-2xl text-shadow-md hover:text-teal-700"
                    href="/">Game <span class="text-teal-400">Hub</span> 🎮</a>
            </div>
            <livewire:search-dropdown>
                <ul class="flex space-x-1 mt-6 sm:space-x-8 lg:mt-0">
                    <li><a href="#"
                            class="text-xs font-bold transition duration-500 ease-in-out border-2 border-transparent py-1 px-2 rounded hover:border-teal-400 hover:shadow-md sm:text-base">Games</a>
                    </li>
                    <li><a href="#"
                            class="text-xs font-bold transition duration-500 ease-in-out border-2 border-transparent py-1 px-2 rounded hover:border-teal-400 hover:shadow-md sm:text-base">Reviews</a>
                    </li>
                    <li><a href="#"
                            class="text-xs font-bold transition duration-500 ease-in-out border-2 border-transparent py-1 px-2 rounded hover:border-teal-400 hover:shadow-md sm:text-base">Upcoming</a>
                    </li>
                    <li><a href="#"
                            class="text-xs font-bold transition duration-500 ease-in-out border-2 border-teal-400 py-1 px-2 rounded shadow-md hover:bg-teal-400 hover:text-gray-800 sm:text-base">Sign
                            in</a></li>
                </ul>
        </nav>
    </header>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 border-t-4 border-teal-400">
        <div class="container mx-auto px-4 py-6 font-semibold text-gray-100">
            GAME <span class="text-teal-400">HUB</span> - Powered by <a class="border-b-2 border-teal-400"
                target="_blank" href="https://api-docs.igdb.com/">IGDB
                API</a>
        </div>
    </footer>

    <livewire:scripts>
</body>

</html>
