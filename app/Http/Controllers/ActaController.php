<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActaController extends Controller
{
    public function create()
    {
        $mesas = Mesa::all();
        return view('actas.create', compact('mesas'));
    }

    public function index(Request $request)
    {
        $query = Acta::with(['mesa', 'user'])->orderBy('id', 'DESC');

        // Filtro por mesa
        if ($request->mesa) {
            $query->whereHas('mesa', function ($q) use ($request) {
                $q->where('codigo', 'LIKE', "%{$request->mesa}%");
            });
        }

        // Filtro por nivel
        if ($request->nivel && $request->nivel !== 'todos') {
            $query->where('nivel', $request->nivel);
        }

        // Filtro fecha desde
        if ($request->desde) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        // Filtro fecha hasta
        if ($request->hasta) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        // Búsqueda global
        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('mesa', function ($m) use ($request) {
                    $m->where('codigo', 'LIKE', "%{$request->buscar}%");
                })
                    ->orWhere('nivel', 'LIKE', "%{$request->buscar}%")
                    ->orWhereHas('user', function ($u) use ($request) {
                        $u->where('name', 'LIKE', "%{$request->buscar}%");
                    });
            });
        }

        $actas = $query->paginate(15)->withQueryString();

        return view('actas.index', compact('actas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesa_codigo' => 'required|string|max:50',
            'nivel'       => 'required|in:alcalde,presidencial',
            'archivo'     => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // *** NORMALIZAR CÓDIGO DE MESA ***
        $codigoMesa = trim(strtoupper($request->mesa_codigo));

        // Buscar mesa ya normalizada
        $mesa = Mesa::firstOrCreate(
            ['codigo' => $codigoMesa],
            ['centro' => 'Sin definir', 'municipio' => null, 'departamento' => null]
        );

        // Evitar duplicados por nivel
        $actaExistente = Acta::where('mesa_id', $mesa->id)
            ->where('nivel', $request->nivel)
            ->first();

        if ($actaExistente) {
            return back()
                ->with('error', '⚠ Esta mesa ya tiene acta registrada para este nivel.')
                ->withInput();
        }

        // Guardar archivo
        $archivo = $request->hasFile('archivo')
            ? $request->file('archivo')->store('actas', 'public')
            : null;

        // Crear acta
        Acta::create([
            'user_id' => Auth::id(),
            'mesa_id' => $mesa->id,
            'nivel'   => $request->nivel,
            'archivo' => $archivo,

            'nacional' => $request->nacional ?? 0,
            'liberal'  => $request->liberal ?? 0,
            'libre'    => $request->libre ?? 0,
            'dc'       => $request->dc ?? 0,
            'pinu'     => $request->pinu ?? 0,
            'nulos'    => $request->nulos ?? 0,
            'blancos'  => $request->blancos ?? 0,

            'total' => collect([
                $request->nacional,
                $request->liberal,
                $request->libre,
                $request->dc,
                $request->pinu,
                $request->nulos,
                $request->blancos
            ])->sum(),
        ]);

        return back()->with('success', 'Acta registrada correctamente.');
    }

    public function edit($id)
    {
        $acta = Acta::with('mesa')->findOrFail($id);
        return view('actas.edit', compact('acta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mesa_codigo' => 'required|string|max:50',
            'nivel'       => 'required|in:alcalde,presidencial',
            'archivo'     => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $acta = Acta::findOrFail($id);

        // *** NORMALIZAR CÓDIGO DE MESA ***
        $codigoMesa = trim(strtoupper($request->mesa_codigo));

        // Buscar mesa
        $mesa = Mesa::firstOrCreate(
            ['codigo' => $codigoMesa],
            ['centro' => 'Sin definir']
        );

        // Actualizar archivo si viene
        if ($request->hasFile('archivo')) {
            $acta->archivo = $request->file('archivo')->store('actas', 'public');
        }

        // Actualizar acta
        $acta->mesa_id = $mesa->id;
        $acta->nivel   = $request->nivel;

        $acta->nacional = $request->nacional ?? 0;
        $acta->liberal  = $request->liberal ?? 0;
        $acta->libre    = $request->libre ?? 0;
        $acta->dc       = $request->dc ?? 0;
        $acta->pinu     = $request->pinu ?? 0;
        $acta->nulos    = $request->nulos ?? 0;
        $acta->blancos  = $request->blancos ?? 0;

        $acta->total = collect([
            $acta->nacional,
            $acta->liberal,
            $acta->libre,
            $acta->dc,
            $acta->pinu,
            $acta->nulos,
            $acta->blancos
        ])->sum();

        $acta->save();

        return redirect()->route('actas.index')->with('success', 'Acta actualizada correctamente.');
    }

    public function dashboard()
    {
        // Mesas procesadas totales (sin duplicar)
        $mesasProcesadas = Acta::distinct('mesa_id')->count('mesa_id');

        // Mesas AL alcalde (sin duplicar)
        $mesasAlcalde = Acta::where('nivel', 'alcalde')
            ->distinct('mesa_id')
            ->count('mesa_id');

        // Mesas PRESIDENTE (sin duplicar)
        $mesasPresidente = Acta::where('nivel', 'presidencial')
            ->distinct('mesa_id')
            ->count('mesa_id');

        // Totales generales
        $totalesGeneral = Acta::selectRaw('
        SUM(nacional) as nacional,
        SUM(liberal) as liberal,
        SUM(libre) as libre,
        SUM(dc) as dc,
        SUM(pinu) as pinu,
        SUM(nulos) as nulos,
        SUM(blancos) as blancos
    ')->first();

        // Totales alcalde
        $totalesAlcalde = Acta::where('nivel', 'alcalde')->selectRaw('
        SUM(nacional) as nacional,
        SUM(liberal) as liberal,
        SUM(libre) as libre,
        SUM(dc) as dc,
        SUM(pinu) as pinu
    ')->first();

        // Totales presidente
        $totalesPresidente = Acta::where('nivel', 'presidencial')->selectRaw('
        SUM(nacional) as nacional,
        SUM(liberal) as liberal,
        SUM(libre) as libre,
        SUM(dc) as dc,
        SUM(pinu) as pinu
    ')->first();

        // Últimas actas
        $actas = Acta::with(['mesa', 'user'])
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        // Porcentajes alcalde
        $totalAlcaldeVotos =
            $totalesAlcalde->nacional +
            $totalesAlcalde->liberal +
            $totalesAlcalde->libre +
            $totalesAlcalde->dc +
            $totalesAlcalde->pinu;

        $porcentajeAlcalde = [
            'nacional' => $totalAlcaldeVotos ? round(($totalesAlcalde->nacional / $totalAlcaldeVotos) * 100, 2) : 0,
            'liberal'  => $totalAlcaldeVotos ? round(($totalesAlcalde->liberal  / $totalAlcaldeVotos) * 100, 2) : 0,
            'libre'    => $totalAlcaldeVotos ? round(($totalesAlcalde->libre    / $totalAlcaldeVotos) * 100, 2) : 0,
            'dc'       => $totalAlcaldeVotos ? round(($totalesAlcalde->dc       / $totalAlcaldeVotos) * 100, 2) : 0,
            'pinu'     => $totalAlcaldeVotos ? round(($totalesAlcalde->pinu     / $totalAlcaldeVotos) * 100, 2) : 0,
        ];

        // Porcentajes presidente
        $totalPresidenteVotos =
            $totalesPresidente->nacional +
            $totalesPresidente->liberal +
            $totalesPresidente->libre +
            $totalesPresidente->dc +
            $totalesPresidente->pinu;

        $porcentajePresidente = [
            'nacional' => $totalPresidenteVotos ? round(($totalesPresidente->nacional / $totalPresidenteVotos) * 100, 2) : 0,
            'liberal'  => $totalPresidenteVotos ? round(($totalesPresidente->liberal  / $totalPresidenteVotos) * 100, 2) : 0,
            'libre'    => $totalPresidenteVotos ? round(($totalesPresidente->libre    / $totalPresidenteVotos) * 100, 2) : 0,
            'dc'       => $totalPresidenteVotos ? round(($totalesPresidente->dc       / $totalPresidenteVotos) * 100, 2) : 0,
            'pinu'     => $totalPresidenteVotos ? round(($totalesPresidente->pinu     / $totalPresidenteVotos) * 100, 2) : 0,
        ];

        // Enviar todo a la vista
        return view('actas.dashboard', [
            'mesasProcesadas'      => $mesasProcesadas,
            'mesasAlcalde'         => $mesasAlcalde,
            'mesasPresidente'      => $mesasPresidente,
            'totalesGeneral'       => $totalesGeneral,
            'totalesAlcalde'       => $totalesAlcalde,
            'totalesPresidente'    => $totalesPresidente,
            'porcentajeAlcalde'    => $porcentajeAlcalde,
            'porcentajePresidente' => $porcentajePresidente,
            'actas'                => $actas
        ]);
    }


    public function public()
    {
        $mesasProcesadas = Acta::distinct('mesa_id')->count('mesa_id');

        $totalesGeneral = Acta::selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu,
            SUM(nulos) as nulos,
            SUM(blancos) as blancos
        ')->first();

        $totalesAlcalde = Acta::where('nivel', 'alcalde')->selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu
        ')->first();

        $totalesPresidente = Acta::where('nivel', 'presidencial')->selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu
        ')->first();

        return view('actas.dashboard-publico', [
            'mesasProcesadas'   => $mesasProcesadas,
            'totalesGeneral'    => $totalesGeneral,
            'totalesAlcalde'    => $totalesAlcalde,
            'totalesPresidente' => $totalesPresidente
        ]);
    }

    public function apiResultados()
    {
        $totalesGeneral = Acta::selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu,
            SUM(nulos) as nulos,
            SUM(blancos) as blancos
        ')->first();

        $totalesAlcalde = Acta::where('nivel', 'alcalde')->selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu
        ')->first();

        $totalesPresidente = Acta::where('nivel', 'presidencial')->selectRaw('
            SUM(nacional) as nacional,
            SUM(liberal) as liberal,
            SUM(libre) as libre,
            SUM(dc) as dc,
            SUM(pinu) as pinu
        ')->first();

        $mesasProcesadas = Acta::distinct('mesa_id')->count('mesa_id');

        return response()->json([
            'mesasProcesadas' => $mesasProcesadas,
            'general'         => $totalesGeneral,
            'alcalde'         => $totalesAlcalde,
            'presidente'      => $totalesPresidente
        ]);
    }
}
