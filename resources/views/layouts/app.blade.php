@props([
    'seo' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! seo($seo ?? null) !!}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/sharer.min.js'])

        @if(in_array(
            Route::currentRouteName(),
            [
                'application.contact',
                'apply.create',
                'apply.view',
                'resume.create',
                'resume.show',
                'recruiter.dashboard',
                'recruiter.message.reply',
                'recruiter.message.create',
                'jobseeker.message.reply',
                'jobseeker.message.create',
                'recruiter.resume-message.reply',
                'recruiter.resume-message.create',
                'jobseeker.resume-message.reply',
                'jobseeker.resume-message.create',
                'job.create',
                'job.edit',
                'cover-letter.create',
                'cover-letter.edit',
                'resume.contact',
            ]
        ))
            <script src="https://cdn.tiny.cloud/1/bnewamtv57vskamj5hi9zu9t837zje2rfp17xltp6pfnfbpx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
            <x-tinymce.tinymce-config/>
            @stack('tinymce')

            <link href="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.js"></script>
        @endif

        @if('resume-video.create' === Route::currentRouteName())
            <?php
                $videoUrl = URL::signedRoute('resume-video.store', ['user' => Auth::user()->id]);
            ?>
            <script src="https://www.WebRTC-Experiment.com/RecordRTC.js"></script>
            <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
            <meta name="user-id" content="{{ Auth::user()->id }}">
            <meta name="signed-route" content="{{ $videoUrl }}">
        @endif

        <!-- Styles -->
        @livewireStyles

    </head>
    <body class="font-sans antialiased text-slate-800">
        
        <div class="min-h-screen bg-gradient-to-b from-blue-violet-50/75 to-blue-violet-200 relative">
            @include('partials.header')
            <!-- Page Content -->
            
            <main>
                {{ $slot }}
            </main>

            <img class="absolute bottom-0 start-0 h-auto w-full" src="{{ asset('/img/white_curve.svg') }}" alt="wavy background">
        </div>
        @include('partials.footer')
        <x-impersonate::banner/>
    </body>
</html>