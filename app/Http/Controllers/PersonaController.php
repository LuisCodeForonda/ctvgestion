<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PersonaController extends Controller
{
    public function index(){
        return view('equipos.persona');
    }

    public function pdf(){
        $data = Persona::all();
        $user = Auth::user()->name;
        $fecha = date('d-m-Y');
        $pdf = Pdf::loadView('pdf.personas', ['data' => $data, 'user' => $user, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}
