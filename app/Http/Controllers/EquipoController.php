<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EquipoController extends Controller
{
    //
    public function index()
    {
        return view('equipos.equipo');
    }

    public function show($slug)
    {
        return view('equipos.show', ['slug' => $slug, 'equipo' => Equipo::where('slug', $slug)->first()]);
    }

    public function pdf()
    {
        $data = Equipo::all();
        $user = Auth::user()->name;
        $fecha = date('d-m-Y');
        $pdf = Pdf::loadView('pdf.equipos', ['data' => $data, 'user' => $user, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}
