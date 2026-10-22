<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Throwable;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Se añade ->get() para ejecutar la consulta y obtener la colección
        $modulos = Modulo::orderBy('nombre')->get();
        return view('modulo.index', compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modulo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'abreviatura' => ['required', 'string', 'max:7'],
            'horas' => ['nullable', 'integer', 'min:0', 'max:15'],
            'creditos' => ['nullable', 'numeric', 'min:0', 'max:99.99'],
        ]);

        try {
            // Usamos $datos en lugar de $request->all() para garantizar que solo se guarden campos validados
            Modulo::create($datos);

            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo creado correctamente.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se pudo guardar el módulo. Comprueba que el nombre y la abreviatura no estén repetidos.']);
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se pudo guardar el módulo.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Modulo $modulo)
    {
        // Se cambió el parámetro a Type Hinting (Modulo $modulo) para que el Route Model Binding recupere la instancia
        return view('modulo.show', compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modulo $modulo)
    {
        return view('modulo.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modulo $modulo)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'abreviatura' => ['required', 'string', 'max:7'],
            'horas' => ['nullable', 'integer', 'min:0', 'max:15'],
            'creditos' => ['nullable', 'numeric', 'min:0', 'max:99.99'],
        ]);

        try {
            $modulo->update($datos);

            // Se corrigió redirect -> por redirect()
            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo actualizado correctamente.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se pudo actualizar el módulo. Comprueba que el nombre y la abreviatura no estén repetidos.']);
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Se produjo un error al actualizar el módulo.']);
        }
    }

    /**     
     * Remove the specified resource from storage.
     */
    public function destroy(Modulo $modulo)
    {
        try {
            $modulo->delete();

            return redirect()
                ->route('modulo.index')
                ->with('success', 'Módulo eliminado correctamente.');
        } catch (Exception $e) {
            return back()->withErrors(
                ['error' => 'No se pudo eliminar el módulo.']
            );
        }
    }
}