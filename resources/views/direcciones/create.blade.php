@extends('layouts.app')

@section('title', 'Nueva direccion')
@section('content')
<div class="container">
	<h1>Nueva Dirección</h1>

	<form method="POST" action="{{ route('direcciones.store') }}" id="direccionForm">
		@csrf

		<div class="row g-3">
			<div class="col-md-3">
				<label for="pais" class="form-label">País</label>
				<select id="pais" class="form-select" required>
					<option value="">Seleccione...</option>
				</select>
			</div>

			<div class="col-md-3">
				<label for="provincia" class="form-label">Provincia</label>
				<select id="provincia" class="form-select" disabled required>
					<option value="">Seleccione...</option>
				</select>
			</div>

			<div class="col-md-3">
				<label for="partido" class="form-label">Partido</label>
				<select id="partido" class="form-select" disabled required>
					<option value="">Seleccione...</option>
				</select>
			</div>

			<div class="col-md-3">
				<label for="localidad_id" class="form-label">Localidad</label>
				<select name="localidad_id" id="localidad_id" class="form-select" disabled required>
					<option value="">Seleccione...</option>
				</select>
			</div>

			<div class="col-md-6">
				<label for="calle" class="form-label">Calle</label>
				<input type="text" name="calle" id="calle" class="form-control" required>
			</div>

			<div class="col-md-2">
				<label for="numero" class="form-label">Número</label>
				<input type="text" name="numero" id="numero" class="form-control" required>
			</div>

			<div class="col-md-2">
				<label for="piso" class="form-label">Piso</label>
				<input type="text" name="piso" id="piso" class="form-control">
			</div>

			<div class="col-md-2">
				<label for="dpto" class="form-label">Dpto</label>
				<input type="text" name="dpto" id="dpto" class="form-control">
			</div>

			<div class="col-md-3">
				<label for="codigo_postal" class="form-label">Código Postal</label>
				<input type="text" name="codigo_postal" id="codigo_postal" class="form-control">
			</div>
		</div>

		<div class="mt-4">
			<button type="submit" class="btn btn-primary">Guardar</button>
			<a href="{{ route('direcciones.index') }}" class="btn btn-secondary">Cancelar</a>
		</div>
	</form>
</div>

<script>
const fetchJson = async (url) => {
	const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
	if (!res.ok) throw new Error('Error ' + res.status);
	return res.json();
};

const fillSelect = (selectEl, items, placeholder = 'Seleccione...') => {
	selectEl.innerHTML = '';
	const opt0 = document.createElement('option');
	opt0.value = '';
	opt0.textContent = placeholder;
	selectEl.appendChild(opt0);

	items.forEach(item => {
		const opt = document.createElement('option');
		opt.value = item.id;
		opt.textContent = item.nombre;
		selectEl.appendChild(opt);
	});
	selectEl.disabled = items.length === 0;
};

document.addEventListener('DOMContentLoaded', async () => {
	const selPais = document.getElementById('pais');
	const selProv = document.getElementById('provincia');
	const selPart = document.getElementById('partido');
	const selLoc  = document.getElementById('localidad_id');

	// Cargar países
	try {
		const paises = await fetchJson('/paises');
		fillSelect(selPais, paises.data ?? paises);
	} catch (e) {
		console.error(e);
	}


});
</script>
@endsection