<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoriaController extends Controller
{
    //
    public function index(){
        return view('noticias.categoria');
    }

    public function pdf(){
        $data = Categoria::all();
        $user = Auth::user()->name;
        $fecha = date('d-m-Y');
        $pdf = Pdf::loadView('pdf.categorias', ['data' => $data, 'user' => $user, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}
