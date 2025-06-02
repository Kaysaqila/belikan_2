<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingAddressResource\Pages;
use App\Filament\Resources\ShippingAddressResource\RelationManagers;
use App\Models\ShippingAddress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingAddressResource extends Resource
{
    protected static ?string $model = ShippingAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextArea::make('note')
                ->label('Catatan')
                ->columnSpanFull()
                ->disabled(), 

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('note')
                ->label('Catatan')
                ->wrap()
                ->limit(50),
            ])
            ->filters([
                //
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
            //
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
