
// Recoger datos del formulario y campo de captcha
const loginForm = document.getElementById('loginForm');
const captchaInput = document.getElementById('captcha');

// Contador de intentos fallidos
let intentosFallidos = 0;

// Función para validar el formulario
loginForm.addEventListener('submit', function (event) {
    event.preventDefault();

    // Obtener el valor ingresado en el captcha
    const userAnswer = parseInt(captchaInput.value);

    // Comprobar si la respuesta es correcta (5 + 9 = 14)
    if (userAnswer === 14) {
        // Respuesta correcta, permitir el inicio de sesión
        alert('¡Inicio de sesión exitoso!');
        document.write("<h1>Bienvenido!</h1>")
    } else {
        // Respuesta incorrecta, mostrar mensaje de error
        intentosFallidos++;
        alert(`Respuesta incorrecta. Intentos fallidos: ${intentosFallidos}`);

        // Limpiar el campo de captcha
        captchaInput.value = '';

        // Si son 3 intentos fallidos, redirigir a la página de los Mossos
        if (intentosFallidos === 3) {
            alert('Demasiados intentos fallidos. Será redirigido a la página de los Mossos.');
            window.location.href = 'https://mossos.gencat.cat/ca/inici';
        }
    }
});
