<ul class="text-center">
    <!-- Menu Items -->
    @foreach($menu_items as $count => $menu_item)
    <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-slate-300">
        <a class="inline-flex gap-x-2 text-sm text-slate-500 hover:text-slate-800" href="{{url('/')}}/{{$menu_item->url}}">
            {{$menu_item->name}}
        </a>
    </li>
    @endforeach
</ul>