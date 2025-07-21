@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Localidades</h1>
        <a href="{{ url('/localidades/create') }}" class="btn btn-primary mb-3">Nueva Localidad</a>
        {{ $localidades->links() }}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Partido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($localidades as $localidad)
                    <tr>
                        <td>{{ $localidad->id_localidad }}</td>
                        <td>{{ $localidad->nombre }}</td>
                        <td>{{ $localidad->partido->nombre }}</td>
                        <td>
                            <a href="{{ url('/localidades/edit', $localidades) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/localidades/destroy', $localidades) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection