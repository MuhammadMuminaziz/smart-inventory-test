<?php

namespace App\Filament\Resources\IncomingProductResource\Pages;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Filament\Resources\IncomingProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIncomingProducts extends ManageRecords
{
    protected static string $resource = IncomingProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                // Set data
                $data['user_id'] = auth()->id();
                $data['type'] = TransactionType::IN;
                $data['status'] = TransactionStatus::PENDING;

                return $data;
            }),
        ];
    }
}
