<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index(){
        return view('equipo.persona');
    }

    public function pdf(){
        return "pdf";
    }
}
