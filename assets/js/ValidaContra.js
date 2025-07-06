/*
 * Función para mostrar u ocultar la contraseña
 * Cambia el tipo del input de 'password' a 'text' y viceversa
 */
function mostrarContrasena(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
/*
 * Función de validación para asegurarse de que las contraseñas coincidan
 * (Usada principalmente en el formulario de registro)
*/
function validarContrasenas() {
    var contrasena = document.getElementById('contrasena').value;
    var confirmarContrasena = document.getElementById('confirmar').value;

    if (contrasena !== confirmarContrasena) {
        alert('Las contraseñas no coinciden. Por favor, verifique e intente de nuevo.');
        return false; // Evita el envío del formulario
    }
    return true; // Permite el envío del formulario
}

