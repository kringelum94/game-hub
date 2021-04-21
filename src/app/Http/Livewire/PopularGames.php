<?php

namespace App\Http\Livewire;

use App\Config;
use App\Helpers\RefreshIgdbToken;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class PopularGames extends Component
{
    public $popularGames = [];
    public $mostPopularGames = [];

    public function load()
    {
        $popularGamesUnformatted = $this->getPopularGamesUnformatted();

        if (Arr::exists($popularGamesUnformatted, 'message') && Str::contains($popularGamesUnformatted['message'], 'Failure')) {
            RefreshIgdbToken::refresh();
            $popularGamesUnformatted = $this->getPopularGamesUnformatted();
        }

        $this->popularGames = $this->formatForView($popularGamesUnformatted);
        $this->mostPopularGames = array_splice($this->popularGames, 0, 2);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'cover-image' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_screenshot_med/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/555x312',
                'rating' => isset($game['total_rating']) ? round($game['total_rating']) : null,
            ]);
        })->toArray();
    }

    private function getPopularGamesUnformatted()
    {
        return Cache::remember('popular-games', 1, function () {
            $before = Carbon::now()->subMonths(2)->timestamp;
            $after = Carbon::now()->addMonths(2)->timestamp;

            return Http::withHeaders([
                'Client-ID' => env('IGDB_CLIENT_ID'),
                'Authorization' => 'Bearer ' . Config::first()->igdb_key
            ])
                ->withBody(
                    "fields name, cover.image_id, first_release_date, total_rating_count, platforms.abbreviation, total_rating, slug;
                        where first_release_date > {$before} & first_release_date < {$after} & platforms = (48,49,130,6)
                        & total_rating_count > 5;
                        sort total_rating_count desc;
                        limit 6;",
                    "text/plain"
                )->post(ENV('IGDB_URL') . '/games')->json();
        });
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
