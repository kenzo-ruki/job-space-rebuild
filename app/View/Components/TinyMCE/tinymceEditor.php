<?php

namespace App\View\Components\TinyMCE;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tinymceEditor extends Component
{
    
    public $name;
 
    public function mount($name)
    {
        $this->name = $name;
    }
 
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tinymce.tinymce-editor');
    }
}
