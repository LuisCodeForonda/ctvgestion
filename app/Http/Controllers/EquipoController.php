<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    //

    public function index(){
        return view('equipo.equipo.index');
    }

    public function create(){
        return view('equipo.equipo.create');
    }

    public function edit(Equipo $equipo){
        return view('equipo.equipo.edit', compact('equipo'));
    }

    public function show($slug){
        return view('equipo.show', ['slug' => $slug, 'equipo' => Equipo::where('slug', $slug)->first()]);
    }

    public function pdf(){
        return "pdf";
    }
}
