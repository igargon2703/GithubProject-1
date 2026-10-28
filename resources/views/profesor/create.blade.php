@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('profesor.store') }}" method="post">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                            value="{{ old('nombre') }}" required maxlength="100" 
                            placeholder="Introduce el nombre del profesor">
                        @error('nombre')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Apellido --}}
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" 
                            value="{{ old('apellido') }}" required maxlength="130" 
                            placeholder="Introduce los apellidos del profesor">
                        @error('apellido') {{-- Corregido: 'apellido' en lugar de 'apellidos' --}}
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Fecha de falta / alta --}}
                    <div class="mb-3">
                        <label for="falta" class="form-label">Fecha de alta</label>
                        {{-- Corregido: name="falta" e id="falta" en lugar de "fnac" --}}
                        <input type="date" class="form-control" id="falta" name="falta" 
                            value="{{ old('falta') }}" required max="{{ now()->format('Y-m-d') }}">
                        @error('falta') {{-- Corregido: 'falta' en lugar de 'fnac' --}}
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Salario --}}
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario</label>
                        {{-- Corregido: Se eliminó el max="10" para permitir salarios reales --}}
                        <input type="number" class="form-control" id="salario" name="salario" 
                            value="{{ old('salario') }}" min="0" step="0.01" 
                            placeholder="Introduce el salario" required>
                        @error('salario')
                            <div class="alert alert-danger" role="alert" style="margin-top: 6px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Especialidad --}}
                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" 
                            value="{{ old('especialidad') }}" required maxlength="100" 
                            placeholder="Introduce la especialidad del profesor">
                        @error('especialidad')
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