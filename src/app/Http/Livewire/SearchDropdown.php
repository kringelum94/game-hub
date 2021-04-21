<?php

namespace App\Http\Livewire;

use App\Config;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $results = [];

    public function render()
    {
        if (strlen($this->search) >= 2) {
            $gameResults = Http::withHeaders([
                'Client-ID' => env('IGDB_CLIENT_ID'),
                'Authorization' => 'Bearer ' . Config::first()->igdb_key
            ])
                ->withBody(
                    "fields name, cover.image_id, slug;
                    search \"{$this->search}\";
                    limit 6;",
                    "text/plain"
                )->post(ENV('IGDB_URL') . '/games')->json();

            $this->results = $this->formatForView($gameResults);
        }

        return view('livewire.search-dropdown');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'cover-image' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_cover_small/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/90x120',
            ]);
        })->toArray();
    }
}
