<?php

namespace App\Livewire\Form;

use App\Livewire\Concerns\HasUniqueKeyInput;
use App\Support\FormIcons;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DownloadForm extends Component implements HasSchemas
{
    use HasUniqueKeyInput;
    use InteractsWithSchemas;

    private string $hintIcon = FormIcons::HINT;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $qrCode = QrCode::size(200)
            ->margin(0)
            ->format('png')
            ->errorCorrection('H')
            ->merge('https://logos-world.net/wp-content/uploads/2020/06/Real-Madrid-Logo.png', .9, true)
            ->generate(route('home', ['id' => 3445]));

        $qrCodeBase64 = 'data:image/png;base64,'.base64_encode($qrCode);

        return $schema
            ->components([
                $this->uniqueKeyInput()->default('3434')->readOnly()
                    ->helperText('TRADUCIR: Go this this page on your Kobo/Kindle ereader and you see a
                unique key. Enter it in this form and upload an ebook and
                it will appear as a download link on the ereader.'),
                ImageEntry::make('qr')->defaultImageUrl($qrCodeBase64)->hiddenLabel()
                    ->helperText('TRADUCIR: scan this to open the website on the other device')

            ])
            ->statePath('data');
    }

    public function create(): void
    {

        dd($this->form->getState());
    }

    public function render(): View
    {
        return view('livewire.form.download-form');
    }
}
