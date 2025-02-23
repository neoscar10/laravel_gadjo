<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use app\Models\Order;
use app\Models\Address;
use Filament\Tables\Columns\TextColumn;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                ->required()
                ->maxLength(255),

                TextInput::make('last_name')
                ->required()
                ->maxLength(255),

                TextInput::make('phone')
                ->required()
                
                ->maxLength(20),

                TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),

                TextInput::make('city')
                ->required()
                ->maxLength(255),

                TextInput::make('state')
                ->required()
                ->maxLength(255),

                Textarea::make('street_address')
                ->required()
                ->columnSpanFull(),
            ])
            ;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                Tables\Columns\TextColumn::make("first_name"),

                Tables\Columns\TextColumn::make("last_name")
                ->label('Last Name'),

                Tables\Columns\TextColumn::make("phone"),

                Tables\Columns\TextColumn::make("email"),

                Tables\Columns\TextColumn::make("city"),
                Tables\Columns\TextColumn::make("state"),

                Tables\Columns\TextColumn::make("street_address"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
