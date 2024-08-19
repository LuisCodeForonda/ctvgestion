<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function equipos(){
        return $this->hasMany(Equipo::class, 'equipo_id');
    }

    public function componentes(){
        return $this->hasMany(Componente::class, 'componente_id');
    }
}
