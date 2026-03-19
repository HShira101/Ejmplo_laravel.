<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hoteles = Hotel::all();
        return view('Hoteles', compact('hoteles'));
    }
}
