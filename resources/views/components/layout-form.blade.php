@props(['width' => 'xl'])

<form wire:submit="save" class="max-w-{{ $width }} mx-auto p-4 border-2 shadow-md rounded-md">
    {{ $slot }}
</form>
