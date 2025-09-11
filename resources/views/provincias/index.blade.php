@extends('layouts.app')

@section('title', 'Listado de Provincias')
@section('content')

<div class="justify-content-between">
    <h2>Listado de Provincias</h2>
    <a href="{{ route('provincias.create') }}" class="btn btn-success d-inline ">Nueva Provincia</a>
</div>
<div class='table-responsive mt-4'>
    {{ $provincias->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">País</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($provincias as $provincia)
                <tr>
                    <td>{{ $provincia->id_provincia }}</td>
                    <td>{{ $provincia->nombre }}</td>
                    <td>{{ $provincia->pais->nombre ?? '' }}</td>
                    <td>
                        <a href="{{ route('provincias.edit', $provincia->id_provincia) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('provincias.destroy', $provincia->id_provincia) }}" method="POST" style="display:inline;">
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