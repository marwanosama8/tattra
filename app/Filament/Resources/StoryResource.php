<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryResource\Pages;
use App\Filament\Resources\StoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Story;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Category')
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->searchable()
                            ->required()
                            ->getSearchResultsUsing(fn (string $search) => Category::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Category::find($value)?->name),
                    ]),
                Fieldset::make('Story')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('story')
                        ->required()
                        ])->columns(1),
                Fieldset::make('Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStories::route('/'),
            'create' => Pages\CreateStory::route('/create'),
            'edit' => Pages\EditStory::route('/{record}/edit'),
        ];
    }
}