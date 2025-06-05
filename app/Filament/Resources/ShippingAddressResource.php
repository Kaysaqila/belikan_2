<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingAddressResource\Pages;
use App\Models\ShippingAddress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShippingAddressResource extends Resource
{
    protected static ?string $model = ShippingAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('recipient_name')
                    ->label('Recipient Name')
                    ->required(),
                
                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),
                
                Forms\Components\TextArea::make('address')
                    ->label('Address')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\TextArea::make('note')
                    ->label('Note')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipient_name')
                    ->label('Recipient Name')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->wrap()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('note')
                    ->label('Note')
                    ->wrap()
                    ->limit(50),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationships if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippingAddresses::route('/'),
            'create' => Pages\CreateShippingAddress::route('/create'),
            'edit' => Pages\EditShippingAddress::route('/{record}/edit'),
        ];
    }
}
