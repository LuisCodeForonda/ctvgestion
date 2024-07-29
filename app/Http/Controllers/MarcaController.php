<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MarcaController extends Controller
{
    //
    public function index(){
        return view('equipos.marca');
    }

    public function pdf(){
        $data = Marca::all();
        $user = Auth::user()->name;
        $fecha = date('d-m-Y');
        $pdf = Pdf::loadView('pdf.marcas', ['data' => $data, 'user' => $user, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}
