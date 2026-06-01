<div>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button color="success">
traduccion        </x-filament::button>

    </form>

    <x-filament-actions::modals />
</div>
