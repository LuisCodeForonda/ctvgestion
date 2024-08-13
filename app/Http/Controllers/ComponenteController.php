<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponenteController extends Controller
{
    //
    public function index(){
        return view('equipo.componente');
    }

    public function pdf(){
        return "pdf";
    }
}
