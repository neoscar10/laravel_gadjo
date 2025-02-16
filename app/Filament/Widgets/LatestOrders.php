<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use Filament\Tables\Columns\TextColumn;


class LatestOrders extends BaseWidget
{
    protected int| string | array $columnSpan = "full";

    protected static ?int $sort=2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('user.name')
                ->label('Customer')
                ->searchable(),

                TextColumn::make('grand_total')
                ->label('Order Total')
                ->money('NGN'),

                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match($state){
                    'new' => 'info',
                    'processing' => 'warning',
                    'delivered' => 'success',
                    'shipped' => 'success',
                    'cancelled' => 'danger'
                })
                ->icon(fn (string $state): string => match($state){
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'delivered' => 'heroicon-m-check-badge',
                    'cancelled' => 'heroicon-m-x-circle',
                    'shipped' => 'heroicon-m-check-badge',
                })
                ->sortable(),

                TextColumn::make('payment_method')
                ->sortable()
                ->searchable(),

                TextColumn::make('payment_status')
                ->sortable()
                ->badge()
                ->color(fn (string $state): string => match($state){
                    'pending' => 'info',
                    'paid' => 'success',
                    'failed' => 'danger'
                })
                ->searchable(),

                TextColumn::make('created_at')
                ->label('Order Date')
                ->sortable()
                ->dateTime(),
            ])->actions([
                Action::make('View Order')
                ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                ->icon('heroicon-m-eye'),
            ]);
    }
}
