<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarcaController extends Controller
{
    //
    public function index(){
        return view('equipo.marca');
    }

    public function pdf(){
        return "pdf";
    }
}
