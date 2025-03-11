<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;

class UpdateStatusAction
{
    public static function make(): Action
    {
        return Action::make('updateStatus')
            ->label('Update Status')
            ->icon('heroicon-o-check-circle')
            ->color('success')
            ->requiresConfirmation()
            ->form([
                Select::make('status')
                    ->options(fn() => collect(TransactionStatus::asArray())->mapWithKeys(fn($item) => [$item => $item])->toArray())
                    ->required(),
            ])
            ->action(function (Model $record, array $data) {
                $record->update([
                    'status' => $data['status'],
                ]);

                Notification::make()
                    ->success()
                    ->title('Success')
                    ->body('Status updated successfully')
                    ->send();
            });
    }
}
