<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Menu';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('menu_text')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),

                Select::make('menu_type')
                    ->label('Tipe Menu')
                    ->options([
                        'menu' => 'Menu',
                        'dropdown' => 'Dropdown',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('menu_id')->sortable(),
                TextColumn::make('menu_text')->label('Nama Menu')->sortable(),
                TextColumn::make('menu_type')->label('Tipe Menu')->sortable(),
            ])
            ->defaultSort('menu_id', 'asc')
            ->filters([
                SelectFilter::make('menu_type')
                    ->label('Filter Menu')
                    ->options([
                        '' => 'All Menu',
                        'menu' => 'Menu',
                        'dropdown' => 'Dropdown',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
