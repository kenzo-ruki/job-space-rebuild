<?php

namespace App\Livewire\Sliders;

use Livewire\Component;
use App\Models\Slider as SliderModel;

class Slider extends Component
{
    public $slider;
    public $slides;

    public function mount()
    {
        if ($this->slider && $this->slider->slides->count()) {
            $this->slides = $this->slider->slides;
        }
    }

    public function render()
    {
        return view('sliders.slider');
    }
}
