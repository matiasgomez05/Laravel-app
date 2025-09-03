@extends('layouts.app')

@section('title', 'Listado de Paises')
@section('content')

<h2>Listado de Paises</h2>
<div class="table-responsive mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Codigo</th>
                <th scope="col">Capital</th>
                <th scope="col">Moneda</th>
                <th scope="col">Numero de telefono</th>
                <th scope="col">Acciones</th>
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