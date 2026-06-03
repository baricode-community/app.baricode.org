<?php

namespace App\Filament\Resources\Academy\OrderResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('uuid')->label('UUID')->disabled(),
            Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                    'expired' => 'Expired',
                ])
                ->required(),
            TextInput::make('midtrans_transaction_id')->label('ID Transaksi Midtrans')->disabled(),
        ]);
    }
}
