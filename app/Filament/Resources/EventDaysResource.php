<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventDaysResource\Pages;
use App\Models\EventDays;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventDaysResource extends Resource
{
    protected static ?string $model = EventDays::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'SET';

    protected static ?string $modelLabel = 'ပိတ်ရက်';

    protected static ?string $pluralModelLabel = 'ပိတ်ရက်များ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('ခေါင်းစဉ်')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('event_date')
                    ->label('ရက်စွဲ')
                    ->required()
                    ->native(false)
                    ->unique(table: EventDays::class, column: 'event_date', ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('event_date')->date('Y-m-d')->sortable(),
            ])
            ->defaultSort('event_date', 'desc')
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
            'index' => Pages\ListEventDays::route('/'),
            'create' => Pages\CreateEventDays::route('/create'),
            'edit' => Pages\EditEventDays::route('/{record}/edit'),
        ];
    }
}
