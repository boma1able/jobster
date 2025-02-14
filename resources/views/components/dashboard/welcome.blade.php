<div class="flex justify-end mb-10">
    <h5 class="text-xs">Hello,
        <strong>
            <a href="{{ route('dashboard.profile.show', Auth::user()->id) }}" class="underline">{{ Auth::user()->name }}</a>
        </strong>
    </h5>
</div>
