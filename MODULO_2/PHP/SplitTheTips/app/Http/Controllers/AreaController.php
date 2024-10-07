<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;


class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-areas');
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user->company) {
            Log::warning('Attempt to access areas without company', ['user_id' => $user->id]);
            return redirect()->route('company.dashboard')->with('error', 'No tienes una empresa asociada.');
        }
    
        $areas = Auth::user()->company->areas;
        return view('company.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('company.areas.form');
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user->company) {
            return redirect()->route('home')->with('error', 'No tienes una compañía asociada.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tip_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $area = Auth::user()->company->areas()->create($validatedData);
        return redirect()->route('company.areas.index')->with('success', 'Area created successfully');
    }

    public function edit(Area $area)
    {
        return view('company.areas.form', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tip_percentage' => 'required|numeric|min:0|max:100',
        ]);

        try {
            $area->update($validatedData);
            return redirect()->route('company.areas.index')->with('success', 'Área actualizada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el área: ' . $e->getMessage());
        }
    }

    public function destroy(Area $area)
    {
        try {
            $area->delete();
            return redirect()->route('company.areas.index')->with('success', 'Área eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el área: ' . $e->getMessage());
        }
    }
}