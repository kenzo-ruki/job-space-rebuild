<div id="subscriptions-tab">
    <!-- Table -->
    <table class="min-w-full divide-b divide-slate-200">
        <thead class="bg-slate-50">
            <!-- Subs Header Row -->
            <tr class="bg-slate-100">
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-l-full">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden lg:table-cell">
                    Start Date
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 hidden md:table-cell">
                    End Date
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider bg-slate-100 rounded-r-full">
                    Status
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @if($subscriptions)
                @foreach($subscriptions as $subscription)
                    @include('recruiter.subscriptions.card', ['subscription' => $subscription])
                @endforeach
            @endif
        </tbody>
    </table>
    <!-- End Table -->
</div>