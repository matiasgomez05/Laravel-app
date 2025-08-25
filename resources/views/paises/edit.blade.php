@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Editar País</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('paises.update', $pais->id_pais) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del País *</label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $pais->nombre) }}" 
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código *</label>
                            <input type="text" 
                                   class="form-control @error('codigo') is-invalid @enderror" 
                                   id="codigo" 
                                   name="codigo" 
                                   value="{{ old('codigo', $pais->codigo) }}" 
                                   required>
                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capital" class="form-label">Capital *</label>
                            <input type="text" 
                                   class="form-control @error('capital') is-invalid @enderror" 
                                   id="capital" 
                                   name="capital" 
                                   value="{{ old('capital', $pais->capital) }}" 
                                   required>
                            @error('capital')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="moneda" class="form-label">Moneda *</label>
                            <input type="text" 
                                   class="form-control @error('moneda') is-invalid @enderror" 
                                   id="moneda" 
                                   name="moneda" 
                                   value="{{ old('moneda', $pais->moneda) }}" 
                                   required>
                            @error('moneda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="numero_de_telefono" class="form-label">Número de Teléfono *</label>
                            <input type="number" 
                                   class="form-control @error('numero_de_telefono') is-invalid @enderror" 
                                   id="numero_de_telefono" 
                                   name="numero_de_telefono" 
                                   value="{{ old('numero_de_telefono', $pais->numero_de_telefono) }}" 
                                   required>
                            @error('numero_de_telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('paises.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection