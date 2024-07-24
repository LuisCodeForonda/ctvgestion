<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $fillable = ['equipo_id', 'user_id', 'descripcion', 'estado'];

    public function equipos(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function usuarios(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
