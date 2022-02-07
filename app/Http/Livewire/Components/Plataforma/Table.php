<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;
use App\Models\Plataforma;

class Table extends Component
{
    public $id_linha = 0;
    public $opcao = ["cadastrar","editar","deletar"];
    protected $listeners = [
        'plataformas-reload' => '$refresh',
        'marcarLinha',
        'deletarPlataforma'
    ];
    public $msg_toast = [
        "titulo" => '',
        "information" => '',
        "opcao_type" => ["info" => 0,"success" => 1, "warning" => 2 ,"error" => 3,"" => 4],
        "opcao" => 0,
        "tempo" => 5000
    ];
    public $msg_question = [
        "titulo" => '',
        "information" => ''
    ];
    /**
     * Verfica se a tabela de plataformas possui alguma linha marcada
     * true = sim
     * false = nao
     */
    private function verficarLinha()
    {
        return ($this->id_linha <= 0) ?false:true;
    }

    /**
     * Envia um evento para marcar a linha e atribui valor da linha ao id
     */
    public function marcarLinha($id_linha)
    {
        $this->id_linha = $id_linha;
        $this->emit('plataforma.table.marcarLinha', $this->id_linha);
    }

    /**
     * abrir modal com formulario do tipo cadastro
     */
    public function createOpenModal()
    {
        $this->emitTo('components.plataforma.formulario', 'setOpcao', 0, array_search('cadastrar', $this->opcao));
        $this->emit('plataforma.table.openModal');
        //zera linha caso esteja previamente marcada
        $this->id_linha = 0;
    }

    /**
     * Abre modal com formulario no estilo de cadastro
     */
    public function editOpenModal()
    {
        if($this->verficarLinha()){
            $this->emitTo('components.plataforma.formulario', 'setOpcao', $this->id_linha, array_search('editar', $this->opcao));
        }else{//linha não marcada
            $this->msg_toast["titulo"] = "Alerta!";
            $this->msg_toast["information"] = "Plataforma não selecionada! <br> Clique em uma plataforma!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
        }
    }

    /**
     * Alerta de pergunta de exclusao
     */
    public function showAlertQuestion()
    {
        if($this->verficarLinha()){
            $this->msg_question['titulo'] = 'Atenção!';
            $this->msg_question['information'] = 'Realmente deseja excluir esta plataforma?';
            $this->emit('plataforma.table.questionMsg', $this->msg_question, $this->id_linha);
            $this->id_linha = 0;
        }else{//linha não marcada
            $this->msg_toast["titulo"] = "Alerta!";
            $this->msg_toast["information"] = "Plataforma não selecionada! <br> Clique em uma plataforma!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
        }
    }
    /**
     * Deletar Plataforma
     */

     public function deletarPlataforma($id_plataforma)
     {
        try {
            Plataforma::where('id', $id_plataforma)->forceDelete();
            $this->msg_toast["titulo"] = "Sucesso!";
            $this->msg_toast["information"] = "Plataforma deletada permanentemente do banco!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
            $this->emit('plataformas-reload');
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Error!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
        }
     }

    public function render()
    {
        return view('livewire.components.plataforma.table', [
            'plataformas' => Plataforma::orderBy('plataforma')->get(),
        ]);
    }
}
