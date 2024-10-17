<?php

namespace App\Http\Requests\home;

use Illuminate\Foundation\Http\FormRequest;

class AnaliseExameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            // direcionar para o medico data e horario do exame
            # fazer listagem de medicos disponiveis
        ];
    }
}
