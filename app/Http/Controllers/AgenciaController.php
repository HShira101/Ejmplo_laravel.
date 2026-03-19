<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agencia;

class AgenciaController extends Controller
{
    public function index()
    {
        $agencias = Agencia::all();
        return view('Agencias', compact('agencias'));
    }
}
