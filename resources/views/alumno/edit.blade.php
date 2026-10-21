@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('alumno.update', $alumno) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ old('nombre', $alumno->nombre) }}" id="nombre" name="nombre"
                            required maxlength="100" placeholder="Introduce el nombre del alumno">
                        @error('nombre')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="{{ old('apellido', $alumno->apellido) }}" id="apellido"
                            name="apellido" required maxlength="130" placeholder="Introduce los apellidos del alumno">
                        @error('apellidos')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fnac" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" value="{{ old('fnac' ,$alumno->fnac) }}" id="fnac" name="fnac">
                        @error('fnac')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select class="form-select" id="genero" name="genero">
                            <option value="" @selected(old('genero' ,$alumno->genero) == '')>Selecciona una opción</option>
                            <option value="hombre" @selected(old('genero' ,$alumno->genero) == 'hombre')>Masculino</option>
                            <option value="femenino" @selected(old('genero' , $alumno->genero) == 'femenino')>Femenino</option>
                            <option value="otro" @selected(old('genero' ,$alumno->genero) == 'otro')>Otro</option>
                        </select>
                        @error('genero')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="notaacceso" class="form-label">Nota de acceso</label>
                        <input type="number" value="{{ old('notaacceso', $alumno->notaacceso) }}" class="form-control" id="notaacceso"
                            name="notaacceso" min="0" max="10" step="0.01" placeholder="Introduce la nota de acceso">
                        @error('notaacceso')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-secondary">
                        Editar alumno
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection