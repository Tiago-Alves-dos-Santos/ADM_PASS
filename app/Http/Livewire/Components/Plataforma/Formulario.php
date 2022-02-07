<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;
use App\Models\Plataforma;

class Formulario extends Component
{
    public $id_plataforma = 0;
    public $plataforma = null;
    public $opcao = ["cadastrar","editar","deletar"];

    protected $rules = [
        'plataforma' => 'required|min:5',
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

    public function createPlataforma()
    {
        try {
            if(!Plataforma::verficarExistencia($this->plataforma, $this->opcao[0])){
                Plataforma::create([
                    "plataforma" => $this->plataforma
                ]);
                $this->msg_toast["titulo"] = "Sucesso!";
                $this->msg_toast["information"] = "Plataforma cadastrada com sucesso!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
                $this->emit('plataforma.toast', $this->msg_toast);
            }else{//caso exista
                $this->msg_toast["titulo"] = "Alerta!";
                $this->msg_toast["information"] = "Plataforma já cadastrada!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
                $this->emit('plataforma.toast', $this->msg_toast);
            }
            $this->reset(['plataforma', 'msg_toast']);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Error!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('plataforma.toast', $this->msg_toast);
            $this->reset(['plataforma', 'msg_toast']);
        }
    }

    public function createUpdate()
    {
        $this->validate();
        $this->createPlataforma();
    }

    public function render()
    {
        return view('livewire.components.plataforma.formulario');
    }
}
