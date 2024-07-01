const numCorrecto = 14;

let resUsuario = parseInt(prompt('Introduce la suma de 5 + 9'));

if (resUsuario === numCorrecto) {
    document.write('<h1>Bienvenido!');
} else if (isNaN(resUsuario)) {
    alert('Debes introducir un numero');
    window.location.reload();
} else {
    alert('Incorrecto');
    window.location.reload();
}
