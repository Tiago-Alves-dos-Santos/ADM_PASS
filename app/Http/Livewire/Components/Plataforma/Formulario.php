<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;
use App\Models\Plataforma;

class Formulario extends Component
{
    public $id_plataforma = 0;
    public $plataforma = null;
    public $opcao = ["cadastrar","editar","deletar"];
    public function mount()
    {
        # code...
    }

    public function createPlataforma()
    {
        try {
            if(!Plataforma::verficarExistencia($this->plataforma, $opcao[0])){
                Plataforma::create([
                    "plataforma" => $this->plataforma
                ]);
            }else{//caso exista
                
            }
        } catch (\Exception $e) {
            
        }
    }

    public function render()
    {
        return view('livewire.components.plataforma.formulario');
    }
}
