<?php

namespace App\Http\Livewire\Components\Conta;

use App\Models\Conta;
use Livewire\Component;
use App\Models\Plataforma;
use Livewire\WithPagination;
use App\Models\ContaPlataforma;
use Illuminate\Support\Facades\DB;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_linha = 0;
    public $search_email = null;
    public $search_plataforma = null;
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
    protected $listeners = [
        'contas-reload' => '$refresh',
        'marcarLinha',
        'getSearchValues',
        'deletePlataforma'
    ];

    public function mount()
    {
        
    }
    /**
     * Abrei formulario de filtro, busca
     */
    public function openModalFilter()
    {
       $this->emit('components.conta.openModalContaFilter');
    }
    /**
     * Setar tipo de formulario que sera aberto edição/cadastro
     */
    public function setOpcao($opcao)
    {
        if($opcao === 0){
            $this->id_linha = 0;
            $this->emitTo('components.conta.formulario', 'checkOpcao', $opcao);
        }else if($opcao === 1){
            if($this->verficarLinha()){
                $this->emitTo('components.conta.formulario', 'checkOpcao', $opcao, $this->id_linha);
                $this->id_linha = 0;            
            }else{
                $this->msg_toast["titulo"] = "Alerta!";
                $this->msg_toast["information"] = "Conta não selecionada! <br> Clique em uma conta!";
                $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
                $this->emit('conta.table.toast', $this->msg_toast);
                $this->reset(['msg_toast']);
            }
        }
    }
    /**
     * Verfica se a tabela de contas possui alguma linha marcada
     * true = sim
     * false = nao
     */
    private function verficarLinha()
    {
        return ($this->id_linha <= 0) ?false:true;
    }
    /**
     * Marcar linha da tabela selecionado, possui evento no compo
     */
    public function marcarLinha($id_linha)
    {
        $this->id_linha = $id_linha;
        $this->emit('plataforma.table.marcarLinha', $id_linha);
    }
    public function showQuestionDelete()
    {
        if($this->verficarLinha()){
            $this->msg_question['titulo'] = 'Atenção!';
            $this->msg_question['information'] = 'Realmente deseja excluir esta conta?';
            $this->emit('components.conta.table.showDeleteQuestion', $this->msg_question, $this->id_linha);
            $this->id_linha = 0;
        }else{
            $this->msg_toast["titulo"] = "Alerta!";
            $this->msg_toast["information"] = "Conta não selecionada! <br> Clique em uma conta!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["warning"];
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);    
        }
    }
    public function deletePlataforma($id_contaPlataforma)
    {
        try {
            $contaPlataforma = ContaPlataforma::find($id_contaPlataforma);
            ContaPlataforma::where('conta_id', $contaPlataforma->conta_id)
            ->where('plataforma_id', $contaPlataforma->plataforma_id)
            ->forceDelete();
            Conta::where('id', $contaPlataforma->conta_id)->forceDelete();
            //nao precisa deletar plataforma
            // Plataforma::where('id', $contaPlataforma->plataforma_id)->forceDelete();
            $this->msg_toast["titulo"] = "Sucesso!";
            $this->msg_toast["information"] = "Plataforma desvinculada e conta deletada!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["success"];
            $this->emit('contas-reload');
            $this->emit('conta.table.toast', $this->msg_toast);
        }catch(\PDOException $e){
            $this->msg_toast["titulo"] = "Error de deleção de relaciomento";
            $this->msg_toast["information"] = "O valor não pode ser deletado, pois está vinculado a uma ou mais contas!";
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
        }catch (\Exception $e) {
            $this->msg_toast["titulo"] = "Error!";
            $this->msg_toast["information"] = $e->getMessage();
            $this->msg_toast["opcao"] = $this->msg_toast["opcao_type"]["error"];
            $this->emit('conta.table.toast', $this->msg_toast);
            $this->reset(['msg_toast']);
        }
    }

    /**
     * receber valores de busca
     */
    public function getSearchValues($search_email, $search_plataforma)
    {
        $this->search_email = $search_email;
        $this->search_plataforma = $search_plataforma;
    }

    /**
     * Renderiza com filtro perdndedo leftJOin e sem filtro mantendo o left join
     */
    private function getRender()
    {
        return ContaPlataforma::join('contas', 'contas.id', '=', 'conta_plataformas.conta_id')
            ->join('plataformas', 'plataformas.id', '=', 'conta_plataformas.plataforma_id')
            ->select('plataformas.plataforma', 'contas.email','contas.senha', 'conta_plataformas.*')
            ->where('contas.email','like', "%{$this->search_email}%")
            ->where('plataformas.plataforma','like', "%{$this->search_plataforma}%")
            ->orderBy('email')->orderBy('plataforma')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.components.conta.table', [
            'conta_plataformas' => $this->getRender()
        ]);
    }
}
