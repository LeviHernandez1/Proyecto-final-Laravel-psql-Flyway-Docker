<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class EventoQueryBuilder extends Builder
{
    public function proximos()
    {
        return $this->where('fecha', '>=', now()->toDateString())
        ->orderBy('fecha', 'asc');
    }

    public function enSede(string $lugar)
    {
        return $this->where('lugar','like',"%{$lugar}%");
    }
}