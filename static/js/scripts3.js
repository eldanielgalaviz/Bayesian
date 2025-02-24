function validarContrasenas() {
    const contrasenaInput = document.querySelector('input[name="contra"]');
    const confirmarContrasenaInput = document.querySelector('.contra-confirmar');
    const contrasena = contrasenaInput.value;
    const confirmarContrasena = confirmarContrasenaInput.value;
  
    // Expresión regular que valida la contraseña (mínimo 8 caracteres, al menos una letra mayúscula, una minúscula y un número)
    const contrasenaRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
    if (!contrasenaRegex.test(contrasena)) {
      contrasenaInput.setCustomValidity('La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula y un número');
        contrasenaError.textContent = 'La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula y un número';
    } else {
      contrasenaInput.setCustomValidity('');
    }
  
    if (contrasena !== confirmarContrasena) {
      confirmarContrasenaInput.setCustomValidity('Las contraseñas deben ser iguales');
       confirmarContrasenaError.textContent = 'Las contraseñas deben ser iguales';
    } else {
      confirmarContrasenaInput.setCustomValidity('');
    }
  }

  
  const form = document.querySelector('form');
const btnSiguiente = document.querySelector('#btnSiguiente2');

btnSiguiente.addEventListener('click', function(event) {
  validarContrasenas();

  if (!form.checkValidity()) {
    event.preventDefault();
  }
});
