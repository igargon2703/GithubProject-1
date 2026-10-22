<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

use App\Models\Profesor;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const RULES = [
        'nombre' => 'required|string|max:100|min:2',
        'apellido' => 'required|string|max:130|min:3',
        'fnac' => 'nullable|date|before_or_equal:today',
        'genero' => 'nullable|in:masculino,femenino,otro'
    ];

    private const MESSAGES = [

        'nombre.required' => '',
        'nombre.string' => '',
        'nombre.max' => '',
        'nombre.min' => '',
        'apellidos.required' => '',
        'apellidos.string' => '',
        'apellidos.max' => '',
        'apellidos.min' => '',
        'fnac.date' => '',
        'fnac.before_or_equal' => '',
    ];


    public function index(): View
    {
        session()->forget('success');
        $profesores = Profesor::all();
        return view('profesor.index', ['profesores' => Profesor::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('profesor.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    function store(Request $request): RedirectResponse
    {
        //1º validar

        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $profesor = new Profesor($request->all());
        try {
            $profesor->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(([
                'error' => 'Clave unica duplicada',
                //'nombre' => 'Este campo forma parte de la clave unica.',
                //'apellido' => 'Este campo tambien forma parte de la clave unica',
            ]));
        } catch (\Exception $e) {
            echo ('global');
            dd($e);
        }
        //session(['success' => 'Se ha creado el alumno correctamente']);
        return redirect()->route('profesor.index')->with(['success' => 'Se ha creado el profesor correctamente']);
        return redirect()->route('profesor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor): View
    {
        //
        return view('profesor.show', ['profesor' => $profesor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor): View
    {
        //
        return view('profesor.edit', ['profesor' => $profesor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        try {
            $profesor->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(([
                'error' => 'Clave unica duplicada',
            ]));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(([
                'error' => 'Error al editar el alumno.'
            ]));
        }
        return redirect()->route('profesor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor): RedirectResponse
    {
        try {
            $profesor->delete();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(([
                'error' => 'Error al borrar el profesor.'
            ]));
        }
        return redirect()->route('profesor.index')->with(['success' => 'Se ha borrado el profesor']);
    }
}
