<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;

class Table extends Component
{
    public $id_linha = 0;
    public $opcao = ["cadastrar","editar","deletar"];
    protected $listeners = [
        'marcarLinha'
    ];
    public function marcarLinha($id_linha, $opcao)
    {
        $this->emit('evt.marcarLinha', $id_linha);
    }
    public function render()
    {
        return view('livewire.components.plataforma.table');
    }
}
