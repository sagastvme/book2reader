<div>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button type="submit" color="success" >
            {{__('form.submit')}}
        </x-filament::button>

    </form>

    <x-filament-actions::modals/>
</div>
