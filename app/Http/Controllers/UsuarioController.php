<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioController extends Controller
{
    public function index(){
        return view('admin.usuario');
    }

    public function pdf(){
        $data = User::all();
        $user = Auth::user()->name;
        $fecha = date('d-m-Y');
        $pdf = Pdf::loadView('pdf.usuarios', ['data' => $data, 'user' => $user, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}
