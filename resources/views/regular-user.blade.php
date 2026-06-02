<x-layouts::app>

    <div class="font-class">
        <h1>{{__('html.header.h1')}}</h1>
        <p>{{__('html.header.p')}}</p>
    </div>

    @livewire('form.upload-form')


    <div x-data="{ show: true }" x-show="show">
        <x-filament::callout
            icon="heroicon-o-information-circle"
            color="warning"
        >
            <x-slot name="heading">
                Read before proceeding
            </x-slot>

            <x-slot name="description">
                By using this tool you agree that the ebook you upload is processed on the server and stored for a short time.
            </x-slot>

            <x-slot name="controls">
                <x-filament::icon-button
                    icon="heroicon-m-x-mark"
                    color="gray"
                    label="Dismiss"
                    x-on:click="show = false"
                />
            </x-slot>
        </x-filament::callout>
    </div>
</x-layouts::app>
