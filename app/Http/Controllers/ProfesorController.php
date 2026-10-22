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
    private const RULES = [
        'nombre'       => 'required|string|min:2|max:100',
        'apellido'     => 'required|string|min:3|max:130',
        'falta'        => 'required|date|before_or_equal:today', // Corregido: 'required' en vez de 'nullable'
        'salario'      => 'required|numeric|gte:0|decimal:0,2',   // Corregido: Eliminado 'lte:10'
        'especialidad' => 'required|string|min:2|max:100'
    ];

    private const MESSAGES = [
        'nombre.required'       => 'El nombre es obligatorio.',
        'nombre.min'            => 'El nombre debe tener al menos 2 caracteres.',
        'apellido.required'     => 'El apellido es obligatorio.',
        'apellido.min'          => 'El apellido debe tener al menos 3 caracteres.',
        'falta.required'        => 'La fecha de falta es obligatoria.',
        'falta.date'            => 'La fecha debe tener un formato válido.',
        'falta.before_or_equal' => 'La fecha no puede ser posterior a hoy.',
        'salario.required'      => 'El salario es obligatorio.',
        'salario.numeric'       => 'El salario debe ser un número.',
        'salario.gte'           => 'El salario no puede ser negativo.',
        'especialidad.required' => 'La especialidad es obligatoria.',
    ];

    public function index(): View
    {
        session()->forget('success');
        return view('profesor.index', ['profesores' => Profesor::all()]);
    }

    public function create(): View
    {
        return view('profesor.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            Profesor::create($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Clave única duplicada.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Ocurrió un error al guardar el profesor: ' . $e->getMessage()
            ]);
        }

        return redirect()->route('profesor.index')->with('success', 'Se ha creado el profesor correctamente.');
    }

    public function show(Profesor $profesor): View
    {
        return view('profesor.show', ['profesor' => $profesor]);
    }

    public function edit(Profesor $profesor): View
    {
        return view('profesor.edit', ['profesor' => $profesor]);
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $profesor->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Clave única duplicada.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al editar el profesor.'
            ]);
        }

        return redirect()->route('profesor.index')->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {
        try {
            $profesor->delete();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al borrar el profesor.'
            ]);
        }

        return redirect()->route('profesor.index')->with('success', 'Se ha borrado el profesor correctamente.');
    }
}