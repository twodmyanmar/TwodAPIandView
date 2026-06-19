<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreScheduleTwodResource\Pages;
use App\Models\PreScheduleTwod;
use Filament\Resources\Resource;
use Filament\Schemas\Components\DatePicker;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PreScheduleTwodResource extends Resource
{
    protected static ?string $model = PreScheduleTwod::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = '2D';

    protected static ?string $modelLabel = 'ကြိုတင်ကဏန်း';

    protected static ?string $pluralModelLabel = 'ကြိုတင်ကဏန်းများ';

    protected static ?string $navigationLabel = 'ကြိုတင်ကဏန်းများ';

    public static function openTimeOptions(): array
    {
        return [
            '12:00' => '12:00',
            '12:01' => '12:01',
            '16:20' => '16:20',
            '16:30' => '16:30',
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                DatePicker::make('schedule_date')
                    ->label('ရက်စွဲ')
                    ->required()
                    ->native(false),
                Select::make('open_time')
                    ->label('အဖွင့်ချိန်')
                    ->options(self::openTimeOptions())
                    ->required(),
                TextInput::make('number')
                    ->label('2D')
                    ->required()
                    ->maxLength(4),
                TextInput::make('set')
                    ->label('SET')
                    ->default('--')
                    ->maxLength(50),
                TextInput::make('value')
                    ->label('Value')
                    ->default('--')
                    ->maxLength(50),
                TextInput::make('status')
                    ->label('status')
                    ->default('1')
                    ->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('schedule_date')->date('Y-m-d')->sortable(),
                Tables\Columns\TextColumn::make('open_time')->sortable(),
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('set')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('value')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('schedule_date', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPreScheduleTwods::route('/'),
            'create' => Pages\CreatePreScheduleTwod::route('/create'),
            'edit' => Pages\EditPreScheduleTwod::route('/{record}/edit'),
        ];
    }
}
