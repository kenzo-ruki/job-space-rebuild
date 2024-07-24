
@if(session()->has('message'))
@include('messages.' . session('message')['type'], ['message' => session('message')['text']])
@endif
<div id="messages-tab">
    <!-- Table -->
    <table class="min-w-full divide-b divide-slate-200">
        <thead class="bg-slate-50">
            <!-- Subs Header Row -->
            <tr class="bg-slate-100">
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell rounded-l-full">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100">
                    Title
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    Recruiter
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                    Summary
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @if($messages)
                @foreach($messages as $message)
                    @include('jobseeker.resume-messages.card', ['message' => $message])
                @endforeach
            @endif
        </tbody>
    </table>
    <!-- End Table -->
</div>