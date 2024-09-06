<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'observaciones', 'modelo', 'serie', 'serietec', 'estado', 'area', 'ubicacion' ,'slug', 'marca_id', 'encargado_id'];

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function encargado(){
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }
    
}
