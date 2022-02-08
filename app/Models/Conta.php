<?php

namespace App\Models;

use App\Models\ContaPlataforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function plataformas()
    {
        return $this->belongsToMany(Plataforma::class,'conta_plataformas')->withPivot(['id', 'created_at']);
    }
}
