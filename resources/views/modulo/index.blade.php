@extends('template.base')

@section('before-content')
    <div class="container my-3">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <a class="btn btn-primary" href="{{ route('modulo.create') }}">Crear módulo</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                {{-- Alertas de estado --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Abreviatura</th>
                                <th>Horas</th>
                                <th>Créditos</th>
                                <th colspan="3" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($modulos as $modulo)
                                <tr>
                                    <td>{{ $modulo->id }}</td>
                                    <td>{{ $modulo->nombre }}</td>
                                    <td>{{ $modulo->abreviatura }}</td>
                                    <td>{{ $modulo->horas }}</td>
                                    <td>{{ $modulo->creditos }}</td>

                                    <td>
                                        <a href="{{ route('modulo.show', $modulo) }}"
                                            class="btn btn-sm btn-info text-white">Ver</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('modulo.edit', $modulo) }}" class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                    <td>
                                        <form class="confirm-dialog"
                                            data-message="{{ $modulo->abreviatura }} , {{ $modulo->nombre }}"
                                            action="{{ route('modulo.destroy', $modulo) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay módulos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form.confirm-dialog').forEach(form => {
                form.addEventListener('submit', e => {
                    const message = '¿Seguro que quieres borrar el módulo ' + form.dataset.message + '?';
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection