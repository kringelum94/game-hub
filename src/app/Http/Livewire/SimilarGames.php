<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use App\Config;
use Livewire\Component;

class SimilarGames extends Component
{
    public $games = [];

    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function loadSimilarGames()
    {
        $gameFields = Http::withHeaders([
            'Client-ID' => env('IGDB_CLIENT_ID'),
            'Authorization' => 'Bearer ' . Config::first()->igdb_key
        ])
            ->withBody(
                "fields similar_games.cover.image_id, similar_games.name, similar_games.total_rating_count,
                similar_games.total_rating, similar_games.platforms.abbreviation, similar_games.slug;
                where slug=\"{$this->slug}\";",
                "text/plain"
            )->post(ENV('IGDB_URL') . '/games')->json();

        $this->games = isset($gameFields[0]['similar_games']) ? $this->formatForView($gameFields[0]['similar_games']) : [];
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'cover-image' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_screenshot_med/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/555x312',
                'rating' => isset($game['total_rating']) ? round($game['total_rating']) : null,
            ]);
        })->sortByDesc('total_rating_count')->take(4)->toArray();
    }

    public function render()
    {
        return view('livewire.similar-games');
    }
}
