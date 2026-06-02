<?php

namespace App\Livewire\Concerns;

use App\Support\FormIcons;
use Filament\Forms\Components\TextInput;

trait HasUniqueKeyInput
{
    private string $hintIcon = FormIcons::HINT;
    protected function uniqueKeyInput()
    {
        return TextInput::make('uuid')->trim()->length(4)->extraAttributes(['class' => ''])
            ->inputMode('decimal')->placeholder('----')->label(__('form.id'))
            ->hintIcon($this->hintIcon, tooltip: __('form.id_helper'))->autofocus()->required()->markAsRequired(false);
    }
}
