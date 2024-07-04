const resCorrecta = 14;
let intentos = 3;
const esHumano = () => {

    const resUsuario = parseInt(prompt('Por favor, ingresa el resultado de 5 + 9:'));

    if (isNaN(resUsuario)) {
        alert('Eso no es un número válido.');
    }

    if (resUsuario !== resCorrecta) {
        intentos--;
        if (intentos > 0) {
            alert(`Respuesta incorrecta. Te quedan ${intentos} intentos.`);
            return esHumano();
        } else {
            alert('Tres intentos fallidos.');
            window.location.href = 'https://mossos.gencat.cat/ca/inici';
        }
    } else {
        alert('¡Acceso concedido!');
    }
}

esHumano();
