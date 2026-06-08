<?php

namespace App\Filament\Resources\Movimentos\Schemas;

use Filament\Schemas\Schema;

class MovimentoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->label('Produto')
                    ->relationship(name: 'produto', titleAttribute: 'nome') // <--- O Filament busca o nome aqui
                    ->searchable() 
                    ->preload()
                    ->required(),

                TextInput::make('quantidade')
                    ->required()
                    ->numeric(),

                Select::make('tipo')
                    ->options(['e' => 'E','s'=>'s'])
                    ->required(),
        ]);
    }
}