<?php

namespace App\View\Components;

use App\Models\Advertisement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdUnit extends Component
{
    public ?Advertisement $ad;

    public string $imageClasses;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $position)
    {
        $this->ad = Advertisement::activeForPosition($this->position)->inRandomOrder()->first();
        $this->imageClasses = [
            'top-banner' => 'w-full h-32 object-cover',
            'sidebar-square' => 'w-full aspect-square object-cover',
            'content-middle' => 'w-full h-auto object-cover my-4',
        ][$this->position] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ad-unit');
    }
}
