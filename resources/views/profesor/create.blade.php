@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('profesor.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" value="{{ old('nombre') }}" class="form-control" value="" id="nombre"
                            name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                        @error('nombre')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" value="{{ old('apellido') }}" class="form-control" value="" id="apellido"
                            name="apellido" required maxlength="130" placeholder="Introduce los apellidos del profesor">
                        @error('apellidos')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fnac" class="form-label">Fecha de nacimiento</label>
                        <input type="date" value="{{ old('fnac') }}" class="form-control" value="" id="fnac" name="fnac"
                            max=" {{ now()->format(" Y-m-d ") }}">
                        @error('fnac')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select class="form-select" id="genero" name="genero">
                            <option value="" @selected(old('genero') == '')>Selecciona una opción</option>
                            <option value="hombre" @selected(old('genero') == 'masculino')>Masculino</option>
                            <option value="femenino" @selected(old('genero') == 'femenino')>Femenino</option>
                            <option value="otro" @selected(old('genero') == 'otro')>Otro</option>
                        </select>
                        @error('genero')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary">
                        Crear profesor
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection