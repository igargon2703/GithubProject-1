<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{

    private const RULES = [
            'nombre' => 'required|string|max:100|min:2',
            'apellido' => 'required|string|max:130|min:3',
            'fnac' => 'nullable|date|before_or_equal:today',
            'notaaceso' => 'nullable|numeric|gte:0|lte:10|decimal:0,2',
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
            'notaacesso.numeric' => '',
            'notaacesso.' => '',
            'notaacesso.' => '',
            'notaacesso.' => '',
        ];
    
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
        //1º validar

        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $alumno = new Alumno($request->all());
        try {
            $alumno->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors(([
                'error' => 'Clave unica duplicada',
                //'nombre' => 'Este campo forma parte de la clave unica.',
                //'apellido' => 'Este campo tambien forma parte de la clave unica',
            ]));
        } catch (\Exception $e) {
            echo('global');
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
