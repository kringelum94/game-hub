<?php

namespace App\Http\Livewire;

use App\Config;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component
{
    public $recentlyReviewedGames = [];

    public function load()
    {
        $reviewedGamesUnformatted = Cache::remember('recently-reviewed-games', 120, function () {
            $before = Carbon::now()->subMonths(2)->timestamp;
            $current = Carbon::now()->timestamp;

            return Http::withHeaders([
                'Client-ID' => env('IGDB_CLIENT_ID'),
                'Authorization' => 'Bearer ' . Config::first()->igdb_key
            ])
                ->withBody(
                    "fields name, cover.image_id, summary, first_release_date, total_rating_count, platforms.abbreviation, total_rating, slug;
                    where first_release_date > {$before} & first_release_date < {$current} & platforms = (48,49,130,6) & total_rating_count > 5;
                    sort total_rating_count desc;
                    limit 3;",
                    "text/plain"
                )->post(ENV('IGDB_URL') . '/games')->json();
        });

        $this->recentlyReviewedGames = $this->formatForView($reviewedGamesUnformatted);
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'cover_big' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_cover_big/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/264x352',
                'rating' => isset($game['total_rating']) ? round($game['total_rating']) : null,
                'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->filter()->implode(', ') : '',
            ]);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
