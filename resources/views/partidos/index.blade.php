@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Partidos</h1>
        <a href="{{ url('/partidos/create') }}" class="btn btn-primary mb-3">Nuevo Partido</a>
        {{ $partidos->links() }}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partidos as $partido)
                    <tr>
                        <td>{{ $partido->id_partido }}</td>
                        <td>{{ $partido->nombre }}</td>
                        <td>{{ $partido->provincia->nombre }}</td>
                        <td>
                            <a href="{{ url('/partidos/edit', $partidos) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/partidos/destroy', $partidos) }}" method="POST" style="display:inline;">
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