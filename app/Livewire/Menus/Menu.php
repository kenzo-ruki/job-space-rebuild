<?php

namespace App\Livewire\Menus;

use Livewire\Component;

class Menu extends Component
{
    public $menu;
    public $menu_items;

    public function mount()
    {
        if ($this->menu && $this->menu->menuItems()->count()) {
            $this->menu_items = $this->menu->menuItems()->get();
        }
    }

}
