<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Config;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Str;

class SingleGame extends Component
{
    public $game = [];

    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function loadSingleGame()
    {
        $singleGame = Http::withHeaders([
            'Client-ID' => env('IGDB_CLIENT_ID'),
            'Authorization' => 'Bearer ' . Config::first()->igdb_key
        ])
            ->withBody(
                "fields name, cover.image_id, first_release_date, total_rating_count, platforms.abbreviation, rating,
                slug, involved_companies.company.name, genres.name, aggregated_rating, summary,
                websites.*, videos.*, screenshots.*, similar_games.cover.url, similar_games.name,
                similar_games.rating, similar_games.platforms.abbreviation, similar_games.slug;
                where slug=\"{$this->slug}\";",
                "text/plain"
            )->post(ENV('IGDB_URL') . '/games')->json();

        $this->game = $this->formatForView($singleGame[0]);
    }

    private function formatForView($game)
    {
        return collect($game)->merge([
            'summary' => isset($game['summary']) ? $game['summary'] : '',
            'cover_big' => isset($game['cover']) ? 'https://images.igdb.com/igdb/image/upload/t_cover_big/' . $game['cover']['image_id'] . '.jpg' : 'https://placehold.it/264x352',
            'release_date' => isset($game['first_release_date']) ? Carbon::parse($game['first_release_date'])->format('M d, Y') : 'TBA',
            'genres' => isset($game['genres']) ? collect($game['genres'])->pluck('name')->implode(', ') : 'Not specified',
            'company' => isset($game['involved_companies']) ? $game['involved_companies'][0]['company']['name'] : 'Unknown',
            'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->filter()->implode(', ') : 'Info is missing',
            'member_rating' => isset($game['rating']) ? round($game['rating']) : '0',
            'critic_rating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : '0',
            'trailer' => isset($game['videos']) ? $this->getVideoId($game['videos']) : 'https://youtube.com',
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])->map(function ($screenshot) {
                return [
                    'big' => 'https://images.igdb.com/igdb/image/upload/t_screenshot_big/' . $screenshot['image_id'] . '.jpg',
                    'huge' => 'https://images.igdb.com/igdb/image/upload/t_screenshot_huge/' . $screenshot['image_id'] . '.jpg',
                ];
            })->take(9) : [],
            'socials' => [
                'website' => isset($game['websites']) ? collect($game['websites'])->filter(function ($website) {
                    return !Str::contains($website['url'], 'facebook') && !Str::contains($website['url'], 'instagram') && !Str::contains($website['url'], 'twitter');
                })->first() : '',
                'facebook' => isset($game['websites']) ?  collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first() : '',
                'instagram' => isset($game['websites']) ?  collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first() : '',
                'twitter' => isset($game['websites']) ?  collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first() : '',
            ]
        ]);
    }

    private function getVideoId($videos)
    {
        $videoId = 'https://youtube.com/embed/' . collect($videos)->filter(function ($video) {
            return Str::contains($video['name'], 'Trailer');
        })->pluck('video_id')->first();

        if (!$videoId) {
            $videoId = 'https://youtube.com/embed/' . $videos[0]['video_id'];
        }

        return $videoId;
    }

    public function render()
    {
        return view('livewire.single-game');
    }
}
