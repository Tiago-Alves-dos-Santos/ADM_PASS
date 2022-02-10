<?php

namespace App\Http\Livewire\Components\Conta;

use Livewire\Component;
use App\Models\Plataforma;

class FormFiltro extends Component
{
    public $email = '';
    public $plataforma = '';
    public function setSearchValues()
    {
        $this->emitTo('components.conta.table', 'getSearchValues', $this->email, $this->plataforma);
        $this->emit('components.conta.closeModalContaFilter');
    }
    public function render()
    {
        return view('livewire.components.conta.form-filtro',[
            'plataformas' => Plataforma::orderBy('plataforma')->get()
        ]);
    }
}
