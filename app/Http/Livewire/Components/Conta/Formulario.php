<?php

namespace App\Http\Livewire\Components\Conta;

use App\Models\Conta;
use Livewire\Component;
use App\Models\Plataforma;
use App\Models\ContaPlataforma;

class Formulario extends Component
{
    public $id_conta = 0;
    public $email = null;
    public $senha = null;
    public $id_plataforma = null;
    public $contaPlataformaId = 0;

    public $opcao = ["cadastrar","editar","deletar"];
    public $opcao_type = 0;
    public $msg_toast = [
        "titulo" => '',
        "information" => '',
        "opcao_type" => ["info" => 0,"success" => 1, "warning" => 2 ,"error" => 3,"" => 4],
        "opcao" => 0,
        "tempo" => 5000
    ];
    protected $listeners = [
        'checkOpcao'
    ];
    protected $rules = [
        'email' => 'required|email', 
        'senha' => 'required|min:5', 
        // 'id_plataforma' => 'required|integer'
    ];
    public function checkOpcao($opcao, $id_conta_plataforma = 0)
    {
        if($opcao === array_search('cadastrar', $this->opcao)){
            $this->reset(['id_conta', 'email','senha']);
            $this->opcao_type = $opcao;
            $this->emit('components.conta.openModalForm');
        }else if($opcao === array_search('editar', $this->opcao) && $id_conta_plataforma <= 0){
            throw new \Exception("Parametro id_conta_plataforma inválido na opção editar");
        }else if($opcao === array_search('editar', $this->opcao)){
            $this->opcao_type = $opcao;
            $conta_plataforma = ContaPlataforma::find($id_conta_plataforma);
            $this->contaPlataformaId = $conta_plataforma->id;
            $conta = Conta::find($conta_plataforma->conta_id);
            $this->id_conta = $conta->id;
            $this->email = $conta->email;
            $this->senha = $conta->senha;
            $this->id_plataforma = $conta_plataforma->plataforma_id;
            $this->emit('components.conta.openModalForm');
        }else{
            throw new \Exception("Parametro opção com valor não reconhecido na condição, valor: ".$opcao);
        }
    }
    /**
     * Cadastrar nova conta
     */
    public function cadastrar()
    {
        try {
            $conta = Conta::create([
                "email" => $this->email,
                "senha" => $this->senha,
            ]);
            $conta = $conta->fresh();
            ContaPlataforma::create([
                "plataforma_id" => ($this->id_plataforma == 0 ?null:null),
                "conta_id" => $conta->id
            ]);
            $this->emit('contas-reload');
            $this->msg_toast["titulo"] = "Sucesso!";
            $this->msg_toast["information"] = "Conta alterada som sucesso!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
            $this->emit('components.conta.closeModalForm');
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
            $this->reset(['id_plataforma']);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Erro!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('components.conta.closeModalForm');
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
            $this->reset(['id_plataforma']);
        }
    }
    /**
     * Editar uma conta ja existente
     */
    public function editar()
    {
        try {
            Conta::where('id', $this->id_conta)->update([
                "email" => $this->email,
                "senha" => $this->senha
            ]);
            ContaPlataforma::where('id', $this->contaPlataformaId)->update([
                "plataforma_id" => ($this->id_plataforma == 0 ?null:null)
            ]);
            $this->emit('contas-reload');
            $this->msg_toast["titulo"] = "Sucesso!";
            $this->msg_toast["information"] = "Conta salva som sucesso!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
            $this->emit('components.conta.closeModalForm');
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
            $this->reset(['id_plataforma']);
        } catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Erro!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('components.conta.closeModalForm');
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
            $this->reset(['id_plataforma']);
        }
    }
    
    /**
     * Metodo de formulario cadastrar ou atualizar
     */
    public function createOrUpdater()
    {
        $this->validate();
        if($this->opcao_type === array_search('cadastrar', $this->opcao)){
            $this->cadastrar();
        }else if($this->opcao_type === array_search('editar', $this->opcao)){
            $this->editar();
        }
    }
    public function render()
    {
        return view('livewire.components.conta.formulario',[
            'plataformas' => Plataforma::orderBy('plataforma')->get()
        ]);
    }
}
