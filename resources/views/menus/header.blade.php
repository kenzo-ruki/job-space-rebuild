<div class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:ps-7">
    <!-- Menu Items -->
    @foreach($menu_items as $count => $menu_item)
    <a class="font-medium text-slate-500 hover:text-slate-400 sm:py-6" href="{{url('/')}}/{{$menu_item->url}}">{{$menu_item->name}}</a>
    @endforeach
    @if (Auth::user())
        @if (Auth::user()->hasRole('admin'))
            @livewire('menus.admin')
        @elseif (Auth::user()->hasRole('recruiter'))
            @livewire('menus.recruiter')
        @elseif (Auth::user()->hasRole('jobseeker'))
            @livewire('menus.jobseeker')
        @elseif (Auth::user()->hasRole('user'))
            @livewire('menus.user')
        @else 
            @livewire('menus.guest')
        @endif
    @else 
        @livewire('menus.guest')
    @endif
</div>