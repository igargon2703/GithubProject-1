@extends('template.base')

@section('before-content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <a class="btn btn-secondary" href="{{ route('profesor.create') }}">Crear profesor</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Salario</th>
                            <th>Fecha de alta</th>
                            <th>Especialidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profesores as $profesor)
                            <tr>
                                <td>{{ $profesor->id }}</td>
                                <td>{{ $profesor->nombre }}</td>
                                <td>{{ $profesor->apellido }}</td>
                                <td>{{ $profesor->salario }}</td>
                                <td>{{ \Carbon\Carbon::parse($profesor->falta)->locale('es')->translatedFormat('d/m/Y') }}</td>
                                <td>{{ $profesor->especialidad }}</td>

                                <td> <a href="{{route('profesor.show', $profesor->id)}}" class="btn btn-secondary">View</a></td>
                                <td> <a href="{{route('profesor.edit', $profesor->id)}}" class="btn btn-secondary">Edit</a></td>
                                <!--<td> <a href="{{route('index')}}"class="btn btn-secondary">Delete</a></td>-->
                                <td>
                                    <form class="confirm-dialog"
                                        data-message="{{$profesor->apellido . ' , ' . $profesor->nombre}}"
                                        action="{{route('profesor.destroy', $profesor)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="btn btn-secondary"></input>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelectorAll('form.confirm-dialog').forEach(
            form => {
                form.addEventListener('submit', e => {
                    const message = '¿Seguro que quieres borrar al profesor ' + form.dataset.message + '?';
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                });
            }
        );
    </script>
@endsection