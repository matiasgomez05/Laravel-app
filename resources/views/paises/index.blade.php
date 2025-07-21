@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Paises</h1>
        <a href="{{ url('/paises/create') }}" class="btn btn-primary mb-3">Nuevo Pais</a>
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
                            <a href="{{ url('/paises/edit', $paises) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/paises/destroy', $paises) }}" method="POST" style="display:inline;">
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