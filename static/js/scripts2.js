function validarUsuario() {
	const usuarioInput = document.querySelector('input[name="usuario"]');
	const usuario = usuarioInput.value.trim();

	// Expresión regular que valida el usuario (mínimo 4 caracteres, máximo 16, solo letras y números)
	const usuarioRegex = /^[a-zA-Z0-9]{4,16}$/;

	if (!usuarioRegex.test(usuario)) {
		usuarioInput.setCustomValidity(
			'El usuario debe contener entre 4 y 16 caracteres, y solo puede contener letras y números',
		);
		usuarioError.textContent =
			'El usuario debe contener entre 4 y 16 caracteres, y solo puede contener letras y números';
	} else {
		usuarioInput.setCustomValidity('');
	}
}

function validarContrasena() {
	console.log('asdasd');
	const contrasenaInput = document.querySelector('input[name="contrasena"]');
	const contrasena = contrasenaInput.value;

	// Expresión regular que valida la contraseña (mínimo 8 caracteres, al menos una letra mayúscula, una minúscula y un número)
	const contrasenaRegex =
		/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-."/()¡¿,]).{8,}$/;

	if (!contrasenaRegex.test(contrasena)) {
		console.log('aaaa');
		contrasenaInput.setCustomValidity(
			'La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un símbolo',
		);
		contrasenaError.textContent =
			'La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un símbolo';
	} else {
		contrasenaInput.setCustomValidity('');
	}
}

function validarConfirmarContrasena() {
	const contrasenaInput = document.querySelector('input[name="contrasena"]');
	const confirmarContrasenaInput = document.querySelector(
		'input[name="confirmarContrasena"]',
	);
	const confirmarContrasena = confirmarContrasenaInput.value;

	if (confirmarContrasena !== contrasenaInput.value) {
		confirmarContrasenaInput.setCustomValidity(
			'La contraseña y la confirmación de contraseña no coinciden',
		);
		confirmarContrasenaError.textContent =
			'La contraseña y la confirmación de contraseña no coinciden';
	} else {
		confirmarContrasenaInput.setCustomValidity('');
	}
}

function validarEmail() {
	const emailInput = document.querySelector('input[name="email"]');
	const email = emailInput.value.trim();

	// Expresión regular que valida el correo electrónico
	const emailRegex = /^\S+@\S+\.\S+$/;

	if (!emailRegex.test(email)) {
		emailInput.setCustomValidity('Debe ingresar un correo electrónico válido');
		emailError.textContent = 'Debe ingresar un correo electrónico válido';
	} else {
		emailInput.setCustomValidity('');
	}
}

const form = document.querySelector('form');
const btnSiguiente2 = document.querySelector('#btnSiguiente2');
const $icono = document.querySelector('.icono');

$icono.addEventListener('click', (e) => {
	const contrasenaInput = document.querySelector('input[name="contrasena"]');

	if (e.target.getAttribute('hide') == 'true') {
		e.target.src = '/static/img/hide.png';
		e.target.setAttribute('hide', 'false');
		contrasenaInput.setAttribute('type', 'text');
	} else {
		e.target.src = '/static/img/view.png';
		e.target.setAttribute('hide', 'true');
		contrasenaInput.setAttribute('type', 'password');
	}
});

btnSiguiente2.addEventListener('click', function (event) {
	validarUsuario();
	validarContrasena();
	validarConfirmarContrasena();
	validarEmail();

	if (!form.checkValidity()) {
		event.preventDefault();
	}
});
