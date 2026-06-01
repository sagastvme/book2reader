<?php

namespace App\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
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
        $allowedTypes = collect([
            'application/epub+zip' => 'EPUB',
            'application/x-mobipocket-ebook' => 'MOBI',
            'application/pdf' => 'PDF',
            'application/vnd.comicbook+zip' => 'CBZ',
            'application/vnd.comicbook-rar' => 'CBR',
            'text/html' => 'HTML',
            'text/plain' => 'TXT',
            'application/zip' => 'ZIP',
            'application/x-rar-compressed' => 'RAR',
        ]);

        return $schema
            ->components([
                FileUpload::make('books')->multiple()
                    ->acceptedFileTypes($allowedTypes->keys())->maxSize(50000) // 50MB
                    ->requiredWithout('url')
                    ->label(__('form.books'))->helperText(__('form.books_help', ['formats' => $allowedTypes->values()
                    ->implode(', ')]))->columnSpanFull(),

                TextInput::make('url')->url()->inputMode('url')->autocomplete('url')
                    ->trim()
                    ->requiredWithout('books')
                    ->label(__('form.url'))->helperText(__('form.url_help')),
                Fieldset::make('traduccion')->components([

                    Radio::make('process')->hiddenLabel()->options([
                        null => __('form.process.none'),
                        'kobo' => __('form.process.kobo'),
                        'kindle' => __('form.process.kindle'),
                    ])->descriptions([
                        null => __('form.process.none_desc'),
                        'kobo' => __('form.process.kobo_desc'),
                        'kindle' => __('form.process.kindle_desc'),
                    ])->inline()->default(null),

                ]),
                Toggle::make('trim_margins')
                    ->inline()->onColor('extra')
                    ->label(__('form.trim_margins_help'))
                    ->helperText(__('form.trim_margins_help')),

                Toggle::make('transliterate')
                    ->inline()->onColor('danger')
                    ->label(__('form.transliterate'))
                    ->helperText(__('form.transliterate_help')),

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
