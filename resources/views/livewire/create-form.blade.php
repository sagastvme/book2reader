<div>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button type="submit" color="success">
            {{__('form.submit')}}
        </x-filament::button>
    </form>

    <div class="qr-container" style="text-align: center; margin: 20px;">


        @php
            // 1. Generamos el QR y lo guardamos en una variable (esto devuelve datos binarios)
            $qrCode = QrCode::size(200)
//                ->color(255, 0, 0)
                ->margin(0)
                ->format('png')
                // OJO: Cambié el .8 a .3 (ver nota abajo)
                ->errorCorrection('H')
                ->merge('https://logos-world.net/wp-content/uploads/2020/06/Real-Madrid-Logo.png', .9, true)
                ->generate(route('home', ['id' => 3445]));
        @endphp

        <img src="data:image/png;base64, {!! base64_encode($qrCode) !!}" alt="QR Code">

    </div>
    <x-filament-actions::modals/>
</div>
