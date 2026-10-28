@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                {{-- Mensaje de error general si salta una excepción --}}
                @if ($errors->has('error'))
                    <div class="alert alert-danger mb-3">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <form action="{{ route('profesor.update', $profesor) }}" method="post">
                    @method('put')
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="{{ old('nombre', $profesor->nombre) }}" id="nombre"
                            name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                        @error('nombre')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Apellidos --}}
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="{{ old('apellido', $profesor->apellido) }}"
                            id="apellido" name="apellido" required maxlength="130"
                            placeholder="Introduce los apellidos del profesor">
                        @error('apellido')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Especialidad --}}
                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" class="form-control" value="{{ old('especialidad', $profesor->especialidad) }}"
                            id="especialidad" name="especialidad" required maxlength="100"
                            placeholder="Introduce la especialidad del profesor">
                        @error('especialidad')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Fecha de falta --}}
                    <div class="mb-3">
                        <label for="falta" class="form-label">Fecha de falta</label>
                        <input type="date" class="form-control" value="{{ old('falta', $profesor->falta) }}" id="falta"
                            name="falta" required>
                        @error('falta')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Salario --}}
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario</label>
                        <input type="number" value="{{ old('salario', $profesor->salario) }}" class="form-control"
                            id="salario" name="salario" min="0" max="100000000" step="0.01"
                            placeholder="Introduce su salario">
                        @error('salario')
                            <div class="text-danger small mt-1">{{ $message }}</div>
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