<?php

namespace App\Http\Livewire\Components\Conta;

use Livewire\Component;

class Table extends Component
{
    protected $listeners = [
        'contas-reload' => '$refresh',
        'marcarLinha'
    ];
    /**
     * Marcar linha da tabela selecionado, possui evento no compo
     */
    public function marcarLinha($id_linha)
    {
        $this->emit('evt.marcarLinha', $id_linha);
    }

    public function render()
    {
        return view('livewire.components.conta.table');
    }
}
