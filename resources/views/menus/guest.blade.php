<div class="flex items-center mb-2 sm:mb-0">
    <!-- Dropdown for Job Seekers -->
    <div class="relative group">
        <div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] sm:py-4">
            <button type="button" class="flex items-center w-full gap-x-1 font-medium text-slate-500 hover:text-blue-600 pe-2">     
                Job Seekers
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </button>
            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 z-10 bg-white sm:shadow-md rounded-2xl px-3 py-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5 hidden">
                <a href={{ route('login') }} class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
                    Login
                </a>
                <a href="{{ route('register.jobseeker') }}" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
                    Register
                </a>
            </div>
        </div>
    </div>

    <!-- Dropdown for Recruiters -->
    <div class="relative group">
        <div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] sm:py-4">
            <button type="button" class="flex items-center w-full gap-x-1 font-medium text-slate-500 hover:text-blue-600 border-s border-slate-300 ps-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                Recruiters
            </button>
            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 z-10 bg-white sm:shadow-md rounded-2xl px-3 py-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5 hidden">
                <a href="/rates" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
                    Rates
                </a>
                <a href={{ route('login') }} class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
                    Login
                </a>
                <a href="{{ route('register.recruiter') }}" class="flex items-center gap-x-3.5 py-2 px-3 my-2 rounded-2xl text-sm text-slate-800 hover:bg-slate-100">
                    Register
                </a>
            </div>
        </div>
    </div>
</div>