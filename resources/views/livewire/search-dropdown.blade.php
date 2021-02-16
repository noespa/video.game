<div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
    <input wire:model.debounce.500ms="search" type="text"
        class="bg-gray-800 text-sm rounded-full focus:outline-none focus:ring focus:border-blue-300 w-64 px-3 pl-8 py-1"
        placeholder="Szukaj ... (naciśnij '/' aby zacząć)" x-ref="search" @keydown.window="
            if(event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        " @focus="isVisible = true" @keydown.escape.window="isVisible = false" @keydown="isVisible = true"
        @keydown.shift.tab="isVisible = false">
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
                d="M21.172 24l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z" />
        </svg>
    </div>

    <div wire:loading class="top-0 right-0 mr-0 mt-1" style="position: absolute">
        <svg class="animate-spin mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>

    @if (strlen($search) >= 2)
    <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2" x-show="isVisible">
        @if (count($searchResult) > 0)
        <ul>
            @foreach ($searchResult as $game)
            <li class="border-b border-gray-700">
                <a href="{{ route('games.show', $game['slug']) }}"
                    class="block hover:bg-gray-700 px-3 py-3 items-center transition ease-in-out duration-150"
                    @if($loop->last)
                    @keydown.tab="isVisible = false"
                    @endif
                    >
                    @if (isset($game['cover']))
                    IMG
                    @endif
                    {{ $game['name'] }}
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="px-3 py-3">No results for "{{ $search }}"</div>
        @endif
    </div>
    @endif
</div>