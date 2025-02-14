@php
    $taxonomy = request()->segment(2);
    use Illuminate\Support\Str;
    $singular = Str::singular($taxonomy);
@endphp

<tr>
    <td class="px-2 py-4 text-sm text-gray-500 min-w-0 w-[300px]">{{ $item->name }}</td>
    <td class="px-2 py-4 text-sm text-gray-500 min-w-0 w-[300px]">{{ \Str::limit(strip_tags($item->description), 50) }}</td>
    <td class="px-2 py-4 text-xs font-medium text-gray-500 min-w-[107px]">{{ $item->slug }}</td>
    <td class="px-2 py-4 text-xs font-medium text-gray-500 min-w-[107px]">
        <p class="flex justify-center">
            <a href="{{ url('/' . $singular . '/' . $item->slug)}}" class="hover:text-black hover:underline">{{ $item->posts()->count() }}</a>
        </p>
    </td>
    @if(!request()->is('dashboard'))
        <td class="px-2 py-4 text-sm font-medium">
            <div class="flex">
                <a href="{{ route('dashboard.' . $taxonomy . '.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.4142 2.58579C18.7893 2.21071 19.2979 2 19.8284 2C20.3589 2 20.8676 2.21071 21.2426 2.58579C21.6177 2.96086 21.8284 3.46957 21.8284 4C21.8284 4.53043 21.6177 5.03914 21.2426 5.41421L12 14.6569L8 15.6569L9 11.6569L18.4142 2.58579Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <button onclick="openDeleteModal({{ $item->id }}, '{{ $taxonomy }}')" class="text-red-600 hover:text-red-900 ml-4">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H21M19 6V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V6M8 6V4C8 2.89543 8.89543 2 10 2H14C15.1046 2 16 2.89543 16 4V6M10 11V17M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </td>
    @endif

</tr>

