@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-full w-full h-12 px-6 mt-3 pr-16 text-sm text-slate-600 placeholder-slate-400 border border-slate-300 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-transparent']) !!}>
