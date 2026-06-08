<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $fillable = [
        'produto_id',
        'quantidade',
        'tempo',
    ];
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
