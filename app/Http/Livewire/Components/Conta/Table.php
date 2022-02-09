<?php

namespace App\Http\Livewire\Components\Conta;

use Livewire\Component;
use App\Models\ContaPlataforma;

class Table extends Component
{
    public $id_linha = 0;
    public $search_email = '';
    public $search_plataforma = '';
    protected $listeners = [
        'contas-reload' => '$refresh',
        'marcarLinha',
        'getSearchValues'
    ];
    public function openModalFilter()
    {
       $this->emit('components.conta.openModalContaFilter');
    }
    /**
     * Setar tipo de formulario que sera aberto edição/cadastro
     */
    public function setOpcao($opcao,$id_conta_plataforma=0)
    {
        $this->emitTo('components.conta.formulario', 'checkOpcao', $opcao, $id_conta_plataforma);
    }
    /**
     * Marcar linha da tabela selecionado, possui evento no compo
     */
    public function marcarLinha($id_linha)
    {
        $this->id_linha = $id_linha;
        $this->emit('plataforma.table.marcarLinha', $id_linha);
    }

    /**
     * receber valores de busca
     */
    public function getSearchValues($search_email, $search_plataforma)
    {
        $this->search_email = $search_email;
        $this->search_plataforma = $search_plataforma;
    }

    public function render()
    {
        
        return view('livewire.components.conta.table', [
            'conta_plataformas' => ContaPlataforma::join('contas', 'contas.id', '=', 'conta_plataformas.conta_id')
            ->join('plataformas', 'plataformas.id', '=', 'conta_plataformas.plataforma_id')
            ->select('plataformas.plataforma', 'contas.email','contas.senha', 'conta_plataformas.*')
            ->where('email','like', "%{$this->search_email}%")
            ->where('plataforma','like', "%{$this->search_plataforma}%")
            ->orderBy('email')->orderBy('plataforma')
            ->paginate(10)
        ]);
    }
}
