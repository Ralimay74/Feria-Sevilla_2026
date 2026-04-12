<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CasetaResource\Pages;
use App\Models\Caseta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class CasetaResource extends Resource
{
    protected static ?string $model = Caseta::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Casetas';
    protected static ?string $modelLabel = 'Caseta';
    protected static ?string $pluralModelLabel = 'Casetas';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Identificación')
                ->schema([
                    TextInput::make('nombre_caseta')
                        ->label('Nombre de la Caseta')
                        ->placeholder('Ej: Casete El Rocío (opcional para privadas)')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    
                    Forms\Components\Grid::make(3)
                        ->schema([
                            TextInput::make('nombre_calle')
                                ->required()
                                ->maxLength(255)
                                ->label('Calle')
                                ->placeholder('Ej: Joselito el Gallo'),
                            
                            TextInput::make('numero')
                                ->required()
                                ->maxLength(50)
                                ->label('Número Oficial')
                                ->placeholder('Ej: 94, 53-57, s/n'),
                            
                            TextInput::make('numero_secuencial')
                                ->numeric()
                                ->label('Nº Secuencial Calle')
                                ->placeholder('Ej: 1, 2, 3...')
                                ->helperText('Número correlativo en la calle'),
                        ]),
                ]),

            Forms\Components\Section::make('Coordenadas GPS')
                ->description('Coordenadas exactas para navegación')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('lat')
                                ->numeric()
                                ->required()
                                ->step(0.0000001)
                                ->label('Latitud')
                                ->placeholder('37.3719')
                                ->helperText('Google Maps → clic derecho → copiar coordenadas'),
                            
                            TextInput::make('lon')
                                ->numeric()
                                ->required()
                                ->step(0.0000001)
                                ->label('Longitud')
                                ->placeholder('-5.9903')
                                ->helperText('Ej: -5.9903'),
                        ]),
                ]),

            Forms\Components\Section::make('Clasificación')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Select::make('tipo')
                                ->options([
                                    'municipal' => '🏛️ Municipal',
                                    'servicio' => '🚑 Servicio Público',
                                    'privada' => '🎪 Caseta Privada',
                                    'informacion' => 'ℹ️ Información',
                                    'accesibilidad' => '♿ Accesibilidad',
                                ])
                                ->required()
                                ->default('privada'),
                            
                            TextInput::make('distrito')
                                ->maxLength(100)
                                ->label('Distrito')
                                ->placeholder('Ej: Macarena Norte'),
                        ]),
                    
                    TextInput::make('descripcion')
                        ->maxLength(255)
                        ->label('Descripción/Servicio')
                        ->placeholder('Ej: Retén de Bomberos, Caseta de la Peña...'),
                    
                    TextInput::make('anio_feria')
                        ->numeric()
                        ->default(2026)
                        ->label('Año'),
                ]),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nombre_caseta')
                ->label('Nombre')
                ->searchable()
                ->sortable()
                ->placeholder('Sin nombre')
                ->toggleable(),
            
            TextColumn::make('nombre_calle')
                ->label('Calle')
                ->searchable()
                ->sortable()
                ->copyable(),
            
            TextColumn::make('numero_secuencial')
                ->label('Nº')
                ->sortable()
                ->badge()
                ->color('primary'),
            
            TextColumn::make('numero')
                ->label('Nº Oficial')
                ->sortable(),
            
            TextColumn::make('tipo')
                ->badge()
                ->colors([
                    'primary' => 'municipal',
                    'success' => 'servicio',
                    'warning' => 'informacion',
                    'danger' => 'privada',
                    'info' => 'accesibilidad',
                ]),
            
            TextColumn::make('descripcion')
                ->limit(20)
                ->tooltip(fn($record) => $record->descripcion),
            
            TextColumn::make('distrito')
                ->badge()
                ->color('gray')
                ->toggleable(isToggledHiddenByDefault: true),
            
            TextColumn::make('lat')
                ->label('Lat')
                ->copyable()
                ->toggleable(isToggledHiddenByDefault: true),
            
            TextColumn::make('lon')
                ->label('Lon')
                ->copyable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            SelectFilter::make('tipo')
                ->options([
                    'municipal' => 'Municipal',
                    'servicio' => 'Servicio',
                    'privada' => 'Privada',
                    'informacion' => 'Información',
                ]),
            
             Tables\Filters\Filter::make('numero_secuencial')
    ->label('Buscar por número')
    ->form([
        TextInput::make('numero')
            ->label('Número de caseta')
            ->placeholder('Ej: 15, 50...')
            ->numeric()
            ->minLength(1)
            ->maxLength(4),
    ])
    ->query(function ($query, array $data): \Illuminate\Database\Eloquent\Builder {
        return $query->when($data['numero'], function ($q, $valor) {
            // Buscamos EXACTAMENTE el número secuencial para evitar que "15" encuentre "153"
            return $q->where('numero_secuencial', $valor);
        });
    }),
            
            SelectFilter::make('distrito')
                ->options([
                    'Macarena Norte' => 'Macarena Norte',
                    'Triana' => 'Triana',
                    'Este' => 'Este',
                    'Parque Príncipes' => 'Parque Príncipes',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make()->iconButton(),
            Tables\Actions\DeleteAction::make()->iconButton(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('nombre_calle', 'asc')
        ->paginated([25, 50, 100]);
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCasetas::route('/'),
            'create' => Pages\CreateCaseta::route('/create'),
            'edit' => Pages\EditCaseta::route('/{record}/edit'),
        ];
    }
}