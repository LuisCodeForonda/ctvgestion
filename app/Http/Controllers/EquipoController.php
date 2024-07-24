<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    //
    public function index(){
        return view('equipo.index');
    }

    public function show($slug){
        return view('equipo.show', ['slug' => $slug, 'equipo' => Equipo::where('slug', $slug)->first()]);
    }

    public function pdf(){
        return "pdf";
    }
}
