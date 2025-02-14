@props(['jobs'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($jobs as $job)
        <x-dashboard.job-item :job="$job"/>
    @endforeach


</div>
