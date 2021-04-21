<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Config;
use Livewire\Component;

class TopGames extends Component
{
    public $topGames = [];

    public function load()
    {
        $topGamesUnformatted = Cache::remember('top-games', 1, function () {
            $beforeSixMonths = Carbon::now()->subMonths(6)->timestamp;
            $current = Carbon::now()->timestamp;

            return Http::withHeaders([
                'Client-ID' => env('IGDB_CLIENT_ID'),
                'Authorization' => 'Bearer ' . Config::first()->igdb_key
            ])
                ->withBody(
                    "fields name, cover.image_id, first_release_date, total_rating_count, platforms.abbreviation, total_rating, slug;
                    where first_release_date < {$current} & first_release_date > {$beforeSixMonths} & total_rating_count > 20 & platforms = (48,49,130,6);
                    sort total_rating desc;
                    limit 3;",
                    "text/plain"
                )->post(ENV('IGDB_URL') . '/games')->json();
        });

        $this->topGames = $this->formatForView($topGamesUnformatted);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'cover_small' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/90x120',
                'release_date' => isset($game['first_release_date']) ? Carbon::parse($game['first_release_date'])->format('M d, Y') : 'Unknown',
            ]);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.top-games');
    }
}
