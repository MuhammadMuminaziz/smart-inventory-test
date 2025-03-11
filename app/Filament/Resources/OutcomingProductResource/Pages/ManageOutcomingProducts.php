<?php

namespace App\Filament\Resources\OutcomingProductResource\Pages;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Filament\Resources\OutcomingProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOutcomingProducts extends ManageRecords
{
    protected static string $resource = OutcomingProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = auth()->id();
                $data['type'] = TransactionType::OUT;
                $data['status'] = TransactionStatus::PENDING;

                return $data;
            }),
        ];
    }
}
