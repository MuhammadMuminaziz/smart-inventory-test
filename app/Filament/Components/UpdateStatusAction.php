<?php

namespace App\Filament\Components;

use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use App\Enums\TransactionStatus;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class UpdateStatusAction
{
    public static function make(): Action
    {
        return Action::make('updateStatus')
            ->label('Update Status')
            ->icon('heroicon-o-check-circle')
            ->hidden(fn($record) => $record->status == TransactionStatus::COMPLETED || $record->status == TransactionStatus::CANCELLED)
            ->color('success')
            ->requiresConfirmation()
            ->form([
                Select::make('status')
                    ->options(fn() => collect(TransactionStatus::asArray())->mapWithKeys(fn($item) => [$item => $item])->toArray())
                    ->required(),
            ])
            ->action(function (Model $record, array $data) {
                // Update stock product
                $isUpdated = false;
                if ($data['status'] == TransactionStatus::COMPLETED) {
                    $isUpdated = Product::find($record->product_id)->updateStock($record->type, $record->qty);
                }

                if (!$isUpdated) {
                    return Notification::make()
                        ->danger()
                        ->title('Error')
                        ->body('Failed to update stock')
                        ->send();
                }

                $record->update(['status' => $data['status']]);
                return Notification::make()
                    ->success()
                    ->title('Success')
                    ->body('Status updated successfully')
                    ->send();
            });
    }
}
