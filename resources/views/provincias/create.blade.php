@extends('layouts.app')

@section('content')
    <h1>Nueva Provincia</h1>
    <form action="{{ route('provincias.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>País:</label>
        <select name="id_pais" required>
            @foreach($paises as $pais)
                <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <button type="submit">Guardar</button>
    </form>
@endsection