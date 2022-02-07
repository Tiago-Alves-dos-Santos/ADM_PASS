<?php

namespace App\Http\Livewire\Components\Conta;

use Livewire\Component;
use App\Models\Plataforma;

class Formulario extends Component
{
    public function render()
    {
        return view('livewire.components.conta.formulario',[
            'plataformas' => Plataforma::orderBy('plataforma')->get()
        ]);
    }
}
