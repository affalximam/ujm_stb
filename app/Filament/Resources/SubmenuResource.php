<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmenuResource\Pages;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\BelongsTo;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;

class SubmenuResource extends Resource
{
    protected static ?string $model = Submenu::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Submenu';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([

                Select::make('submenu_parent')
                    ->label('Menu')
                    ->options(Menu::where('menu_type', 'dropdown')->pluck('menu_text', 'menu_id')->toArray())
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('submenu_text')
                    ->label('Nama submenu')
                    ->required()
                    ->maxLength(255),

                Select::make('submenu_type')
                    ->label('Tipe submenu')
                    ->options([
                        'submenu' => 'Submenu',
                        'dropdown' => 'Dropdown',
                    ])
                    ->required(),

            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('submenu_id')->sortable(),
                TextColumn::make('parentMenu.menu_text')
                    ->label('Nama submenu')
                    ->formatStateUsing(fn ($record) =>
                        $record->parentMenu ? "{$record->parentMenu->menu_text} > {$record->submenu_text}" : $record->submenu_text
                ),
                TextColumn::make('submenu_type')->label('Tipe submenu'),
            ])
            ->defaultSort('submenu_id', 'asc')
            ->filters([])
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
            'index' => Pages\ListSubmenus::route('/'),
            'create' => Pages\CreateSubmenu::route('/create'),
            'edit' => Pages\EditSubmenu::route('/{record}/edit'),
        ];
    }
}
