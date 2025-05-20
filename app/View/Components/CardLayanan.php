<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardLayanan extends Component
{
    /**
     * Create a new component instance.
     */

    public $src;
    public $alt;
    public $title;
    public $href;

    public function __construct($src, $alt, $title, $href)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->title = $title;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-layanan');
    }
}
