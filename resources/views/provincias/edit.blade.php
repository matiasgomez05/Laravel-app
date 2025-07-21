@extends('layouts.app')

@section('content')
    <h1>Editar Provincia</h1>
    <form action="{{ route('provincias.update', $provincia) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $provincia->nombre }}" required>
        <label>País:</label>
        <select name="id_pais" required>
            @foreach($paises as $pais)
                <option value="{{ $pais->id_pais }}" @if($provincia->id_pais == $pais->id_pais) selected @endif>{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <button type="submit">Actualizar</button>
    </form>
@endsection