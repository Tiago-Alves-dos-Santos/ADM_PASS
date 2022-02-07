<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;
use App\Models\Plataforma;

class Formulario extends Component
{
    public $id_plataforma = 0;
    public $plataforma = null;
    public $opcao = ["cadastrar","editar","deletar"];
    public $opcao_type = 0;

    protected $listeners = [
        'setOpcao'
    ];
    protected $rules = [
        'plataforma' => 'required|min:5|regex:/^[a-zA-Z]/', 
    ];
    public $msg_toast = [
        "titulo" => '',
        "information" => '',
        "opcao_type" => ["info" => 0,"success" => 1, "warning" => 2 ,"error" => 3,"" => 4],
        "opcao" => 0,
        "tempo" => 5000
    ];
    public function mount()
    {
    }

    /**
     * Seta a aopção que vai ser ocorrida, a partir de um botao,
     * direciona para formulario ou abri alert question em caso de deleção
     */
    public function setOpcao($id_plataforma,$opcao)
    {
        $this->id_plataforma = $id_plataforma;
        $this->opcao_type = $opcao;
        if($this->opcao_type === array_search('editar', $this->opcao)){
            $this->plataforma = Plataforma::find($this->id_plataforma)->plataforma;
            //abrir modal
            $this->emit('plataforma.table.openModal');
        }else if($this->opcao_type === array_search('deletar', $this->opcao)){
            //abri alert question 
        }else if($this->opcao_type === array_search('cadastrar', $this->opcao)){
            //reset prpiedades
            $this->reset(['plataforma', 'msg_toast','id_plataforma']);
        }
    }

    /**
     * Metodo de cadastro de plataforma
     */
    public function createPlataforma()
    {
        try {
            if(!Plataforma::verficarExistencia($this->plataforma, $this->opcao[0])){
                Plataforma::create([
                    "plataforma" => mb_strtoupper($this->plataforma)
                ]);
                $this->msg_toast["titulo"] = "Sucesso!";
                $this->msg_toast["information"] = "Plataforma cadastrada com sucesso!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
                $this->emitTo('components.plataforma.table','plataformas-reload');
                $this->emit('plataforma.formulario.toast', $this->msg_toast);
            }else{//caso exista
                $this->msg_toast["titulo"] = "Alerta!";
                $this->msg_toast["information"] = "Plataforma já cadastrada!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
                $this->emit('plataforma.formulario.toast', $this->msg_toast);
            }
            $this->reset(['plataforma', 'msg_toast','opcao_type']);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Error!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
            $this->reset(['plataforma', 'msg_toast','opcao_type']);
        }
    }
    /**
     * Metodo de atualização de plataforma
     */
    public function updatePlataforma()
    {
        try {
            if(!Plataforma::verficarExistencia($this->plataforma, $this->opcao[1], $this->id_plataforma)){
                Plataforma::where('id', $this->id_plataforma)->update([
                    "plataforma" => mb_strtoupper($this->plataforma)
                ]);
                $this->msg_toast["titulo"] = "Sucesso!";
                $this->msg_toast["information"] = "Plataforma atualizada com sucesso!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
                $this->emitTo('components.plataforma.table','plataformas-reload');
                $this->emit('plataforma.formulario.toast', $this->msg_toast);
            }else{//caso exista
                $this->msg_toast["titulo"] = "Alerta!";
                $this->msg_toast["information"] = "Plataforma já cadastrada!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
                $this->emit('plataforma.formulario.toast', $this->msg_toast);
            }
            $this->reset(['plataforma', 'msg_toast','opcao_type']);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Error!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('plataforma.formulario.toast', $this->msg_toast);
            $this->reset(['plataforma', 'msg_toast','opcao_type']);
        }
    }

    /**
     * Meotod de formulario que redireciona para cadastro ou atualização
     */
    public function createUpdate()
    {
        $this->validate();
        if($this->opcao_type === array_search('cadastrar', $this->opcao)){
            $this->createPlataforma();
        }else if($this->opcao_type === array_search('editar', $this->opcao)){
            $this->updatePlataforma();
        }
    }

    public function render()
    {
        return view('livewire.components.plataforma.formulario');
    }
}
