<div>
    <input
        type="text"
        wire:model.live="query"
        placeholder="Пошук..."
        class="border p-2 w-full"
    >

    @if($query)
        <ul class="mt-2 border p-2">
            @forelse($this->results as $result)
                <li class="py-1 border-b last:border-b-0">
                    @if($route)
                        <a href="" class="text-blue-500">
                            {{ $result->{$field} }}
                        </a>
                    @else
                        {{ $result->{$field} }}
                    @endif
                </li>
            @empty
                <li>Нічого не знайдено</li>
            @endforelse
        </ul>
    @endif
</div>
