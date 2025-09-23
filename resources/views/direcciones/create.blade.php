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
				<label for="localidad" class="form-label">Localidad</label>
				<select name="localidad" id="localidad" class="form-select" disabled required>
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
async function fetchData(url) {
	try {
		const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
		if(!response.ok) throw new Error(`error HTTP: ${response.status}`);

		const jsonData = await response.json();
		return jsonData;

	} catch (error) {
		console.error('Error de vinculación de datos', error);
	}
}

function showLoadingForSelect(selectEl) {
	// Oculta el select y muestra un spinner Bootstrap adyacente
	let wrapper = selectEl.nextElementSibling;
	const isSpinner = wrapper && wrapper.classList && wrapper.classList.contains('select-loading-wrapper');
	if (!isSpinner) {
		wrapper = document.createElement('div');
		wrapper.className = 'select-loading-wrapper';
		wrapper.innerHTML = `
		<div class="mt-2 text-center">
			<div class="spinner-border spinner-border-sm text-secondary" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>`;
		selectEl.insertAdjacentElement('afterend', wrapper);
	}
	selectEl.classList.add('d-none');
	selectEl.disabled = true;
}

function hideLoadingForSelect(selectEl) {
	const wrapper = selectEl.nextElementSibling;
	if (wrapper && wrapper.classList && wrapper.classList.contains('select-loading-wrapper')) {
		wrapper.remove();
	}
	selectEl.classList.remove('d-none');
}

const fillSelect = (selectEl, items) => {
	// items === null => mostrar spinner (cargando)
	if (items === null) {
		showLoadingForSelect(selectEl);
		return;
	}

	// Al llegar datos (o vacíos), ocultar spinner y reconstruir opciones
	hideLoadingForSelect(selectEl);
	selectEl.innerHTML = '';
	const opt0 = document.createElement('option');
	opt0.value = '';
	opt0.textContent = 'Seleccione...';
	selectEl.appendChild(opt0);

	(items || []).forEach(item => {
		const opt = document.createElement('option');
		opt.value = item.id;
		opt.textContent = item.nombre;
		selectEl.appendChild(opt);
	});
	selectEl.disabled = !(Array.isArray(items) && items.length > 0);
};

document.addEventListener('DOMContentLoaded', async () => {
	const selPais = document.getElementById('pais');
	const selProvincia = document.getElementById('provincia');
	const selPartido = document.getElementById('partido');
	const selLocalidad  = document.getElementById('localidad');

	// Cargar países
	try {
		fillSelect(selPais, null);
		const paises = await fetchData('/paises');
		fillSelect(selPais, paises);
	} catch (e) {
		console.error(e);
	}

	// Cambio de país -> cargar provincias
	selPais.addEventListener('change', async () => {
		fillSelect(selProvincia, []);
		fillSelect(selPartido, []);
		fillSelect(selLocalidad, []);
		if (!selPais.value) {
			selProvincia.disabled = true; selPartido.disabled = true; selLocalidad.disabled = true;
			return;
		}
		try {
			fillSelect(selProvincia, null);
			const provincias = await fetchData('/provincias?id_pais=' + encodeURIComponent(selPais.value));
			fillSelect(selProvincia, provincias);
		} catch (e) {
			console.error(e);
		}
	});

	// Cambio de provincia -> cargar partidos
	selProvincia.addEventListener('change', async () => {
		fillSelect(selPartido, []);
		fillSelect(selLocalidad, []);
		if (!selProvincia.value) {
			selPartido.disabled = true; selLocalidad.disabled = true;
			return;
		}
		try {
			fillSelect(selPartido, null);
			const partidos = await fetchData('/partidos?id_provincia=' + encodeURIComponent(selProvincia.value));
			fillSelect(selPartido, partidos);
		} catch (e) {
			console.error(e);
		}
	});

	// Cambio de partido -> cargar localidades
	selPartido.addEventListener('change', async () => {
		fillSelect(selLocalidad, []);
		if (!selPartido.value) {
			selLocalidad.disabled = true;
			return;
		}
		try {
			fillSelect(selLocalidad, null);
			const localidades = await fetchData('/localidades?id_partido=' + encodeURIComponent(selPartido.value));
			fillSelect(selLocalidad, localidades);
		} catch (e) {
			console.error(e);
		}
	});
});
</script>
@endsection