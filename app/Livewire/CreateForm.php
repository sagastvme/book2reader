<?php

namespace App\Livewire;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $allowedTypes = ['application/epub+zip', 'application/x-mobipocket-ebook', 'application/pdf', 'application/vnd.comicbook+zip', 'application/vnd.comicbook-rar', 'text/html', 'text/plain', 'application/zip', 'application/x-rar-compressed'];

        return $schema
            ->components([
                FileUpload::make('books')->multiple()
                    ->acceptedFileTypes($allowedTypes)->maxSize(100000)
                    ->requiredWithout('url'),
                TextInput::make('url')->url()->inputMode('url')->autocomplete('url')->suffixIcon(Heroicon::GlobeAlt)
                    ->suffixIconColor('success')->trim()->requiredWithout('books'),

                Radio::make('process')->options([
                    null    => 'None',
                    'kobo'  => 'Kepubify',
                    'kindle' => 'KindleGen',
                ])->descriptions([
                    null    => 'No processing',
                    'kobo'  => 'modification',
                    'kindle' => 'KindleGen',
                ])->inline()
                    ->default(null),
                Toggle::make('trim_margins')
                    ->inline()->helperText('Grants this user full access to the dashboard and settings.'),
                Toggle::make('transliterate')
                    ->inline()->helperText('Grants this user full access to the dashboard and settings.'),

            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render(): View
    {
        return view('livewire.create-form');
    }
}
