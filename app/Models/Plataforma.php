<?php

namespace App\Models;

use App\Models\Conta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plataforma extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    /************RELACIONAMENTOS***************/
    public function contas()
    {
        return $this->belongsToMany(Conta::class,'conta_plataformas');
    }
    /**
     * Verifica existenci da plataforma no modo update e create
     */
    public static function verficarExistencia($plataforma,$opcao, $id_plataforma = 0)
    {
        if($opcao === "cadastrar"){ //modo create
            return Plataforma::where('plataforma',$plataforma)->exists();
        }else if($opcao === "editar" && $id_plataforma <= 0){//caso update exige parametro id platforma
            throw new \Exception("Parametro id_plataforma inválido na opção editar", 1);
        }else if($opcao === "editar"){//modo update
            return Plataforma::where('id','!=',$id_plataforma)->where('plataforma',$plataforma)->exists();
        }else{//opção nao registrada no metodo
            throw new \Exception("Parametro opção com valor não reconhecido na condição, valor: ".$opcao, 1);
        }
    }
}
