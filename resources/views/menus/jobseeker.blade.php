<div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] sm:py-4">
    <button type="button" class="flex items-center w-full text-slate-500 hover:text-slate-400 font-medium">
        {{ Auth::user()->first_name }}
        <svg class="flex-shrink-0 ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"></path>
        </svg>
    </button>

    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 z-10 bg-white sm:shadow-md rounded-2xl px-3 py-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5 hidden" style="">

        <button class="flex text-sm mt-2 border-2 border-transparent rounded-full focus:outline-none focus:border-slate-300 transition">
            <img class="h-12 w-12 mx-auto rounded-full object-cover" src="{{ Auth::user()?->profile_photo_url }}" alt="{{ Auth::user()->first_name }}" />
        </button>
        
        <a href={{ route('jobseeker.dashboard') }} class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Dashboard
        </a>

        <a href="/jobseeker/dashboard#saved-jobs" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Saved Jobs
        </a>

        <a href="/jobseeker/dashboard#applications" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Applications
        </a>

        <a href="/jobseeker/dashboard/#job-alerts" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Searches/Alerts
        </a>

        <a href="/jobseeker/dashboard/#resumes" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Resumes/Videos
        </a>

        <a href="{{ route('jobseeker.messages') }}" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Messages
        </a>

        <a href={{ route('profile.show') }} class="flex items-center gap-x-3.5 py-2 px-3 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
            Profile
        </a>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button ref="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex w-full items-center gap-x-3.5 my-2 py-2 px-3 rounded-2xl text-sm text-slate-800 hover:bg-slate-100" href="/logout">
                Logout
            </button>
        </form>
    </div>
</div>