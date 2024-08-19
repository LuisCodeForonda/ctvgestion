<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ComponenteController extends Controller
{
    //
    public function index(){
        return view('equipo.componente.index');
    }

    public function create(){
        return view('equipo.componente.create');
    }

    public function edit(Componente $componente){
        return view('equipo.componente.edit', compact('componente'));
    }

    public function pdf(){
        $pdf = Pdf::loadView('equipo.componente.pdf', ['data' => Componente::all()]);
        return $pdf->stream("componentes.pdf");
    }
}
