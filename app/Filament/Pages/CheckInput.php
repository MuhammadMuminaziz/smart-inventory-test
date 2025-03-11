<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;

class CheckInput extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.check-input';

    public $inputOne = '';
    public $inputTwo = '';
    public $isChecked = false;
    public $totalChars, $totalMatches, $matchPercentage;

    public function checkMatch()
    {
        if (empty($this->inputOne) || empty($this->inputTwo)) {
            return Notification::make()
                ->title('Error')
                ->body('Both inputs must be filled')
                ->danger()
                ->send();
        }

        $uniqueCharsOne = count_chars(strtoupper($this->inputOne), 1);
        $uniqueCharsTwo = count_chars(strtoupper($this->inputTwo), 1);
        $totalChars = strlen($this->inputOne);

        $matchedChars = 0;

        foreach (array_keys($uniqueCharsOne) as $char) {
            if (isset($uniqueCharsTwo[$char]))
                $matchedChars += min($uniqueCharsOne[$char], $uniqueCharsTwo[$char]);
        }

        $this->totalChars = $totalChars;
        $this->totalMatches = $matchedChars;
        $this->matchPercentage = $totalChars > 0 ? round(($matchedChars / $totalChars) * 100, 2) : 0;
        $this->isChecked = true;
    }
}
