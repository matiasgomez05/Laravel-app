@extends('layouts.app')
@section('title', 'Listado de Clientes -- Editar')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Editar cliente</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                        @csrf
						@method('PUT')

						<div class="mb-3">
							<label for="nombre" class="form-label">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
							@error('nombre')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="apellido" class="form-label">Apellido</label>
							<input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $cliente->apellido) }}" required>
							@error('apellido')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="telefono" class="form-label">Telefono</label>
							<input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}">
							@error('telefono')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="text" name="email" id="email" class="form-control" value="{{  old('email', $cliente->email) }}">
							@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

                        <div class="">
                            <button type="submit" class="btn btn-success me-2">Actualizar cliente</button>
                            <a href=" {{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection