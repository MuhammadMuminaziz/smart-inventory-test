<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Filament\Components\UpdateStatusAction;
use App\Filament\Resources\OutcomingProductResource\Pages;
use App\Models\Transaction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OutcomingProductResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';

    protected static ?string $navigationGroup = 'Transactions';

    protected static ?string $label = 'Outcoming Products';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', TransactionType::OUT);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->relationship('product', 'name')->required(),
                Select::make('customer_id')->relationship('customer', 'name')->required(),
                TextInput::make('qty')->numeric()->required()->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')->sortable()->searchable(),
                TextColumn::make('customer.name')->sortable()->searchable(),
                TextColumn::make('qty')->sortable()->searchable(),
                TextColumn::make('status')->sortable()->searchable()->badge()->color(function (string $state) {
                    return match ($state) {
                        TransactionStatus::PENDING => 'warning',
                        TransactionStatus::COMPLETED => 'success',
                        default => 'danger',
                    };
                }),
                TextColumn::make('created_at')->date('d M Y')->sortable()->searchable(),
            ])
            ->actions([
                UpdateStatusAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOutcomingProducts::route('/'),
        ];
    }
}
