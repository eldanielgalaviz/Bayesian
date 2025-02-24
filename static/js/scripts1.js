// Obtén todos los elementos necesarios
const combobox = document.querySelector(".custom-combobox");
const inputField = combobox.querySelector(".input-field");
const optionsList = combobox.querySelector(".options-list");
const options = combobox.querySelectorAll(".options-list li");
const inputEdad = document.getElementById("edad");

// Agrega un evento de clic al campo de entrada de texto
inputField.addEventListener("click", function () {
    combobox.classList.toggle("open");
});

// Agrega un evento de clic a cada opción de la lista
options.forEach(function (option) {
    option.addEventListener("click", function () {
        inputField.value = option.textContent;
        combobox.classList.remove("open");
    });
});

str = "";
function validarNombres() {
    const nombresInput = document.querySelector('input[name="nombre"]');
    const nombres = nombresInput.value.trim();

    // Expresión regular que valida uno o varios nombres
    const nombresRegex = /^[a-zA-Z]+(?: [a-zA-Z]*)*$/;

    if (!nombresRegex.test(nombres)) {
        nombresInput.setCustomValidity("Debe ingresar al menos un nombre");
        nombresError.textContent = "Debe ingresar al menos un nombre";
    } else {
        nombresInput.setCustomValidity("");
    }
}

function validarApellidos() {
    const apellidosInput = document.querySelector('input[name="apellido"]');
    const apellidos = apellidosInput.value.trim();

    // Expresión regular que valida dos apellidos separados por un espacio
    const apellidosRegex = /^[a-zA-ZñÑ\s]+$/;

    if (!apellidosRegex.test(apellidos)) {
        apellidosInput.setCustomValidity(
            "El apellido o apellidos deben contener solo letras y espacios"
        );

        apellidosError.textContent =
            "El apellido o apellidos deben contener solo letras y espacios";
    } else {
        apellidosInput.setCustomValidity("");
    }
}

function validarEdad() {
    const edadInput = document.querySelector('input[name="edad"]');
    const edad = edadInput.value.trim();

    // Expresión regular que valida cualquier número positivo
    const edadRegex = /^(?:1[89]|[2-9][0-9]|10[0])$/;

    if (!edadRegex.test(edad)) {
        edadInput.setCustomValidity("Debe ingresar una edad entre 18 y 100");
        edadError.textContent = "Debe ingresar un número positivo";
    } else {
        edadInput.setCustomValidity("");
    }
}

const form = document.querySelector("form");
const btnSiguiente = document.querySelector("#btnSiguiente");

btnSiguiente.addEventListener("click", function (event) {
    validarNombres();
    validarApellidos();
    validarEdad();

    if (!form.checkValidity()) {
        event.preventDefault();
    }
});

/*Evento para el input edad
	- Este input solo debe de recibir números
	- La edad no debe exceder los tres digitos de largo
*/
inputEdad.addEventListener("keydown", (e) => {
    // Si la entrada es una de las flechas se retorna para evitar las validaciones
    if (e.key == "ArrowLeft" || e.key == "ArrowRight") return;
    if (e.key == "ArrowUp" || e.key == "ArrowDown") return;
    if (e.key == "Backspace") return;

    // Si el numero ingresado no es número no se guarda el valor
    if (!isFinite(e.key)) e.preventDefault();

    // Si la longitud del input es mayor de dos, ya no se guardarán las siguientes entradas del teclado
    if (e.target.value.length > 2) e.preventDefault();
});
