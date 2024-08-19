<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'observaciones', 'modelo', 'serie', 'cantidad', 'estado', 'marca_id', 'equipo_id'];

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }
}
