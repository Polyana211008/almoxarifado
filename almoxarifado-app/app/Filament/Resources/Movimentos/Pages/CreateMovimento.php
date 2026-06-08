<?php

namespace App\Filament\Resources\Movimentos\Pages;

use App\Filament\Resources\Movimentos\MovimentoResource;
use Filament\Resources\Pages\CreateRecord;
use APP\Models\Produto;
use APP\Models\Movimento;
use Filament\Notifications\Notification;

class CreateMovimento extends CreateRecord
{
    protected static string $resource = MovimentoResource::class;
    /**
     * o que a beforeCreat faz?
     * ...
     * 
     * @param $data recebe os dados do produto
     * @param $produto recebe uma lista com os dados dos produtos pelo id
     */
protected function beforeCreate(): void 
{
    $data = $this->data;

    $produto = Produto::find($data['produto_id']);
    $quantidade = $data['quantidade'];
    $tipo = $data['tipo'];
    
    if ($tipo === 's' && $quantidade > $produto->estoque) {
        Notification::make()
        ->danger
        ->title('Estoque Insuficiente!')
        ->body("O estoque de '{$produto->nome}' é de apenas {$produto->estoque}, mas você tentou retirar {$quantidade}.")
        ->send();

        $this->halt();

    }
}
protected function afterCreate(): void
{
    $movimento = $this->getRecord();
    $produto = $movimento->protudo;

    if ($movimento->tipo === 'e'){
        $produto->increment('estoque', $movimento->quantidade);
    } else {
        $produto->decrement('estoque', $movimento->quantidade);
    }
}
}
