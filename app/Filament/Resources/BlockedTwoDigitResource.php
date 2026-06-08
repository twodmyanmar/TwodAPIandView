<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlockedTwoDigitResource\Pages;
use App\Models\BlockedTwoDigit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlockedTwoDigitResource extends Resource
{
    protected static ?string $model = BlockedTwoDigit::class;

    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';

    protected static ?string $navigationGroup = '2D';

    protected static ?string $modelLabel = 'မရကဏန်း';

    protected static ?string $pluralModelLabel = 'မရကဏန်းများ';

    protected static ?string $navigationLabel = 'မရကဏန်းများ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label('2D (00–99)')
                    ->required()
                    ->maxLength(4)
                    ->dehydrateStateUsing(fn ($state) => BlockedTwoDigit::normalizeNumber((string) $state))
                    ->unique(table: BlockedTwoDigit::class, column: 'number', ignoreRecord: true),
                Forms\Components\Textarea::make('note')
                    ->label('မှတ်ချက်')
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('note')->limit(40),
            ])
            ->defaultSort('number')
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
            'index' => Pages\ListBlockedTwoDigits::route('/'),
            'create' => Pages\CreateBlockedTwoDigit::route('/create'),
            'edit' => Pages\EditBlockedTwoDigit::route('/{record}/edit'),
        ];
    }
}
