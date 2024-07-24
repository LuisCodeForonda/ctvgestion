<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'marca_id', 'modelo', 'serie', 'serietec', 'estado', 'observaciones', 'persona_id','slug'];

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    
}
