@props(['name', 'title', 'maxWidth' => '2xl'])

<div 
    x-data = "{ show: false, name: '{{ $name }}' }"
    x-show = "show" 
    x-on:open-modal.window = "show = ($event.detail.name === name)"
    x-on:close-modal.window = "show = false"
    x-transition

    class="fixed top-0 left-0 w-full h-screen z-10 bg-gray-600/30 overflow-y-auto">
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 max-w-{{ $maxWidth }} mx-auto m-4">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-2  md:p-5 border-b rounded-t dark:border-gray-600">
            {{-- Header --}}
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                @if (isset($title))
                    {{ $title }}
                @endif
            </h3>

            {{-- Close button --}}
            <button type="button" x-on:click="show = false"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="crud-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

        </div>
        <!-- Modal body -->
        <div>
            {{ $body }}
        </div>

        {{-- Modal Footer --}}
    </div>
</div>
