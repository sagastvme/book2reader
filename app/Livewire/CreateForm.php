<?php

namespace App\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    private string $hintIcon = 'heroicon-m-question-mark-circle';

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
                $this->uniqueKeyInput(),
                FileUpload::make('books')->multiple()
                    ->acceptedFileTypes($allowedTypes->keys())->maxSize(50000) // 50MB
                    ->requiredWithout('url')
                    ->label(__('form.books'))
                    ->helperText(__('form.books_help', ['formats' => $allowedTypes->values()
                        ->implode(', ')]))->columnSpanFull(),

                TextInput::make('url')->url()->inputMode('url')->autocomplete('url')
                    ->trim()
                    ->requiredWithout('books')
                    ->label(__('form.url'))->hintIconTooltip(__('form.url_hint'))->hintIcon($this->hintIcon, tooltip: __('form.url_help')),
                Fieldset::make(__('form.processing'))->components([

                    Radio::make('process')->hiddenLabel()->options([
                        null => __('form.process.none'),
                        'kobo' => __('form.process.kobo'),
                        'kindle' => __('form.process.kindle'),
                    ])->descriptions([
                        null => __('form.process.none_desc'),
                        'kobo' => __('form.process.kobo_desc'),
                        'kindle' => __('form.process.kindle_desc'),
                    ])->default(null),
                ]),
                Toggle::make('trim_margins')
                    ->inline()->onColor('extra')
                    ->label(__('form.trim_margins'))
                    ->hintIcon($this->hintIcon, tooltip: __('form.trim_margins_help')),

                Toggle::make('transliterate')
                    ->inline()->onColor('danger')
                    ->label(__('form.transliterate'))
                    ->hintIcon($this->hintIcon, tooltip: __('form.transliterate_help')),


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

    private function uniqueKeyInput()
    {
        return TextInput::make('uuid')->trim()->length(4)->extraAttributes(['class' => ''])
            ->inputMode('decimal')->placeholder('----')->label(__('form.id'))
            ->hintIcon($this->hintIcon, tooltip: __('form.id_helper'))->autofocus()->required()->markAsRequired(false);
    }
}
