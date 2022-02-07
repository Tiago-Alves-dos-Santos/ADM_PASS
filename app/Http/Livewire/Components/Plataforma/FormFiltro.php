<?php

namespace App\Http\Livewire\Components\Plataforma;

use Livewire\Component;
use App\Models\Plataforma;

class FormFiltro extends Component
{
    public $plataforma = null;
    public function searchPlataform()
    {
        $this->emitTo('components.plataforma.table','setSearchPlataform', $this->plataforma);
        $this->emit('plataforma.form-filtro.closeModal');
    }
    public function render()
    {
        return view('livewire.components.plataforma.form-filtro', [
            'plataformas' => Plataforma::orderBy('plataforma')->get(),
        ]);
    }
}
