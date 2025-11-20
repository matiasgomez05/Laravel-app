@extends('layouts.app')

@section('title', 'Listado de Clientes')
@section('content')

<div class="justify-content-between">
    <h2>Listado de Clientes</h2>
</div>
<div class='table-responsive mt-4'>
    {{ $clientes->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Direccion principal</th>
                <th scope="col">Fecha registro</th>
                <th scope="col">Ultima actualizacion</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <?php 
                    $pais = $cliente->direccion->localidad->partido->provincia->pais->nombre;
                    $provincia = $cliente->direccion->localidad->partido->provincia->nombre;
                    $direccionCompleta = $cliente->direccion->calle." ".$cliente->direccion->numero." - ". $provincia ." (". $pais .") " ?? '-';
                ?>
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre ?? '' }}</td>
                    <td>{{ $cliente->apellido ?? '' }}</td>
                    <td>{{ $cliente->telefono ?? '-' }}</td>
                    <td>{{ $cliente->email ?? '-' }}</td>
                    <td>{{ $direccionCompleta }}</td>
                    <td>{{ $cliente->fecha_registro->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $cliente->ultima_actualizacion->diffForHumans() ?? '-' }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection