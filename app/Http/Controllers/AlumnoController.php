<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumnoController extends Controller
{
    public function create(): View
    {
        //
        return view('alumno.create', []);
    }

    public function destroy(Alumno $alumno): RedirectResponse
    {
        dd(['destroy', $alumno]);
    }

    public function edit(Alumno $alumno): View
    {
        //
        return view('alumno.edit', ['alumno' => $alumno]);
    }

    public function index(): View
    {
        return view('alumno.index', ['alumnos' => Alumno::all()]);
    }

    public function show(Alumno $alumno): View
    {
        //
        return view('alumno.show', ['alumno' => $alumno]);
    }

    function store(Request $request): RedirectResponse
    {
        $alumno = new Alumno($request->all());
        try {
            $alumno->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput();
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('alumno.index');
    }

    /*
    function store(Request $request) RedirectResponse{
        //dd($request->all());
        //protected $fillable = ['nombre', 'apellidos', 'fnac', 'genero', 'nacceso'];
        $alumno = new Alumno($request->all());
        /*$alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->genero = $request->genero;
        $alumno->fnac = $request->fnac;
        $alumno->nacceso = $request->nacceso;
        $alumno->save();
        //dd($alumno);
        echo 'parece que todo ha ido bien.';
    }
    */

    public function update(Request $request, Alumno $alumno): RedirectResponse
    {
        $alumno->update($request->all());
        return redirect()->route('alumno.index');
    }
}
