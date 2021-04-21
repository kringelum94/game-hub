<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RatingCircleBig extends Component
{
    public $gameRating;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($gameRating)
    {
        $this->gameRating = $gameRating;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.rating-circle-big');
    }
}
