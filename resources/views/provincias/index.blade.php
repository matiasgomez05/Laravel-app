@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Provincias</h1>
        <a href="{{ url('/provincias/create') }}" class="btn btn-primary mb-3">Nueva Provincia</a>
        {{ $provincias->links() }}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provincias as $provincia)
                    <tr>
                        <td>{{ $provincia->id_provincia }}</td>
                        <td>{{ $provincia->nombre }}</td>
                        <td>{{ $provincia->pais->nombre ?? '' }}</td>
                        <td>
                            <a href="{{ url('/provincias/edit', $provincia) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/provincias/destroy', $provincia) }}" method="POST" style="display:inline;">
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