<div>
    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            <div class="flex justify-between mb-5">
                Jobs
            </div>
        </x-slot:title>
    </x-dashboard.page-title>

    <livewire:dashboard.jobs.jobs-table model="Job" field="title" />

</div>
