<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exame extends Model
{
    use HasFactory;

    protected $table = 'exame';
    protected $fillable = [
        'cartao_sus',
        'endereco',
        'nome_exame',
        'nome_mae',
        'cid10_diagnostico',
        'motivo_consulta',
        'status',
        'user_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
