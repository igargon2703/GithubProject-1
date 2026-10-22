@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('profesor.update', $profesor) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ old('nombre', $profesor->nombre) }}" id="nombre"
                            name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                        @error('nombre')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="{{ old('apellido', $profesor->apellido) }}"
                            id="apellido" name="apellido" required maxlength="130"
                            placeholder="Introduce los apellidos del profesor">
                        @error('apellidos')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fnac" class="form-label">Fecha de alta</label>
                        <input type="date" class="form-control" value="{{ old('falta', $profesor->falta) }}" id="falta"
                            name="falta">
                        @error('falta')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notaacceso" class="form-label">Salario</label>
                        <input type="number" value="{{ old('salario') }}" value="" class="form-control" id="salario"
                            name="salario" min="0" max="10" step="0.01" placeholder="Introduce el salario">
                        @error('salario')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Especialidad</label>
                        <input type="text" value="{{ old('especialidad') }}" class="form-control" value="" id="especialidad"
                            name="especialidad" required maxlength="130"
                            placeholder="Introduce la especialidad del profesor">
                        @error('especialidad')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-secondary">
                        Editar profesor
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection