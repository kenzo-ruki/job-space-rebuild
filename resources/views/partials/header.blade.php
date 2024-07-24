<?php
use App\Models\Menu;
$header_menu = Menu::where('location', '=', 'header')->get()->first();
$logo = isset($settings['logo']) ? $settings['logo']->value : false;
?>
<header class="print:hidden flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white border-b border-slate-200 text-sm py-3">
    <nav class="relative max-w-[75rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
        <div class="flex items-center justify-between">
            <a class="flex-none text-xl font-semibold" href="/" aria-label="Brand">
                @if ($logo)
                <img class="h-10 lg:h-16" src="{{ asset('/img/' . $logo) }}" alt="Logo">
                @else
                {{$settings['site_name']->value}}
                @endif
            </a>
            <div class="sm:hidden">
                <button type="button" class="hs-collapse-toggle w-9 h-9 flex justify-center items-center text-sm font-semibold rounded-lg border border-slate-200 text-slate-800 hover:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" x2="21" y1="6" y2="6"></line>
                    <line x1="3" x2="21" y1="12" y2="12"></line>
                    <line x1="3" x2="21" y1="18" y2="18"></line>
                    </svg>
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">  
            @if ($header_menu)
                @livewire('menus.header', ['menu' => $header_menu])
            @endif
        </div>
    </nav>
</header>