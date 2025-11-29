<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::latest()->paginate(20);
        return view('mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('mesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'centro' => 'required',
        ]);

        Mesa::create($request->all());

        return redirect()->route('mesas.index')->with('success', 'Mesa creada.');
    }
}
