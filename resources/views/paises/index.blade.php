@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Países</h1>
            <a href="{{ route('paises.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo País
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Capital</th>
                    <th>Moneda</th>
                    <th>Numero de telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paises as $pais)
                    <tr>
                        <td>{{ $pais->id_pais }}</td>
                        <td>{{ $pais->nombre }}</td>
                        <td>{{ $pais->codigo }}</td>
                        <td>{{ $pais->capital }}</td>
                        <td>{{ $pais->moneda }}</td>
                        <td>{{ $pais->numero_de_telefono }}</td>
                        <td>
                            <a href="{{ route('paises.edit', $pais->id_pais) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('paises.destroy', $pais->id_pais) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este país?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection