<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'equipo_id', 'marca_id', 'modelo', 'serie', 'cantidad'];

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
