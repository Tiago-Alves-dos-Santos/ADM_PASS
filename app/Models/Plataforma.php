<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plataforma extends Model
{
    use HasFactory;
    use SoftDeletes;
    public static function verficarExistencia($plataforma,$opcao, $id_plataforma = 0)
    {
        if($opcao === "cadastrar"){
            return Plataforma::where('plataforma',$plataforma)->exists();
        }else if($opcao === "editar" && $id_plataforma <= 0){
            throw new \Exception("Parametro id_plataforma inválido na opção editar", 1);
        }else if($opcao === "editar"){
            return Plataforma::where('id','!=',$id_plataforma)->where('plataforma',$plataforma)->exists();
        }else{
            throw new \Exception("Parametro opção com valor não reconhecido na condição, valor: ".$opcao, 1);
        }
    }
}
