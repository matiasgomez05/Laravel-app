@extends('layouts.app')

@section('title', 'Listado de Direcciones')
@section('content')

<div class="justify-content-between">
    <h2>Listado de Direcciones</h2>
    <a href="{{ route('direcciones.create') }}" class="btn btn-success d-inline ">Nueva Direccion</a>
</div>
<div class='table-responsive mt-4'>
    {{ $direcciones->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Pais</th>
                <th scope="col">Provincia</th>
                <th scope="col">Partido</th>
                <th scope="col">Localidad</th>
                <th scope="col">Calle</th>
                <th scope="col">Numero</th>
                <th scope="col">Piso</th>
                <th scope="col">Cód. Pos.</th>
                <th scope="col">Cliente</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($direcciones as $direccion)
                <tr>
                    <td>{{ $direccion->id_direccion }}</td>
                    <td>{{ $direccion->localidad->partido->provincia->pais->nombre ?? '' }}</td>
                    <td>{{ $direccion->localidad->partido->provincia->nombre ?? '' }}</td>
                    <td>{{ $direccion->localidad->partido->nombre ?? '' }}</td>
                    <td>{{ $direccion->localidad->nombre ?? '' }}</td>
                    <td>{{ $direccion->calle ?? '' }}</td>
                    <td>{{ $direccion->numero ?? '' }}</td>
                    <td>{{ $direccion->piso ?? '' }}</td>
                    <td >{{ $direccion->codigo_postal ?? '' }}</td>
                    <td>{{ $direccion->cliente->nombre ?? '' }}</td>
                    <td>
                        <a href="{{ route('direcciones.edit', $direccion->id_direccion) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('direcciones.destroy', $direccion->id_direccion) }}" method="POST" style="display:inline;">
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