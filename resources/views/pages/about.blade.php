<?php 

use App\Models\TeamMember;

$team_members = TeamMember::all();
?>
<x-app-layout :seo="$seo">

    <div class="page about">
        <!-- Title -->
        <div class="w-full title">
            <div class="max-w-[75rem] mx-auto pt-20 px-6 lg:px-8">
                <h1 class="text-center w-full block font-bold text-slate-700">{{$page->title}}</h1>
            </div>
        </div>
        <!-- End Title -->
    
        <!-- Content -->
        <div class="w-full content relative pt-24 overflow-hidden px-6">
            <img class="absolute -bottom-[65px] -left-[35px] h-[400px] w-auto z-1" src="{{ asset('/img/left_planets1.svg') }}" alt="wavy background">
            <div class="relative max-w-[75rem] min-h-[800px] mx-auto mb-0 z-10 rounded-t-2xl bg-white px-6 md:px-12 lg:px-20 py-16">
                <div class="body text-lg text-slate-800 space-y-3 md:space-y-5">
                    {!! $page->body !!}
                </div>
    
            </div>
        </div>
        <!-- End Content -->
    
        <!-- Team -->
        <div class="team bg-gradient-to-b from-blue-violet-400 to-blue-violet-300 pb-32 px-3 relative overflow-hidden">
            <img class="absolute bottom-[120px] -right-[120px] h-[450px] w-auto z-1" src="{{ asset('/img/right_planets1.svg') }}" alt="wavy background">
            <div class="relative max-w-[75rem] mx-auto py-24 z-10 px-6 lg:px-8">
                <h2 class="text-center w-full block text-3xl font-bold text-white mb-12">Meet The Team</h2>
    
                <!-- Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-12">
    
                    @foreach($team_members as $team_member)
                        <div class="flex flex-col items-center text-center p-4 md:p-6 align-bottom">
                            <div class="flex rounded-full bg-white w-[300px] h-[300px]  lg:h-[380px]  lg:w-[380px] items-center">
                                <img class="w-[180px] lg:w-[240px] h-auto mx-auto mb-3" src="{{$team_member->getThumbnail()}}" alt="Image Description">
                            </div>
                            <h3 class="font-medium text-white w-full mt-3">
                                {{$team_member->name}}
                            </h3>
                            <p class="uppercase text-white w-full">
                                {{$team_member->position}}
                            </p>
                            <p class="text-md uppercase text-white w-full">
                                {{$team_member->email}}
                            </p>
                            <p class="text-md uppercase text-white w-full">
                                {{$team_member->phone}}
                            </p>
                        </div>
                    @endforeach
    
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Team -->
    </div>
    
</x-app-layout>