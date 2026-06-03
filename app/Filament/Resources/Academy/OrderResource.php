<?php

namespace App\Filament\Resources\Academy;

use App\Filament\Resources\Academy\OrderResource\Pages\ListOrders;
use App\Filament\Resources\Academy\OrderResource\Pages\ViewOrder;
use App\Filament\Resources\Academy\OrderResource\Schemas\OrderForm;
use App\Filament\Resources\Academy\OrderResource\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $slug = 'academy-orders';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static UnitEnum|string|null $navigationGroup = 'Academy';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}'),
        ];
    }
}
