<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Config;

class UpcomingGames extends Component
{
    public $upcomingGames = [];

    public function load()
    {
        $upcomingGamesUnformatted = Cache::remember('upcoming-games', 120, function () {
            $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
            $current = Carbon::now()->timestamp;

            return Http::withHeaders([
                'Client-ID' => env('IGDB_CLIENT_ID'),
                'Authorization' => 'Bearer ' . Config::first()->igdb_key
            ])
                ->withBody(
                    "fields name, cover.image_id, first_release_date, total_rating_count, platforms.abbreviation, total_rating, slug;
                where first_release_date > {$current} & first_release_date < {$afterFourMonths} & platforms = (48,49,130,6);
                sort total_rating_count desc;
                limit 3;",
                    "text/plain"
                )->post(ENV('IGDB_URL') . '/games')->json();
        });

        $this->upcomingGames = $this->formatForView($upcomingGamesUnformatted);
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
        return view('livewire.upcoming-games');
    }
}
