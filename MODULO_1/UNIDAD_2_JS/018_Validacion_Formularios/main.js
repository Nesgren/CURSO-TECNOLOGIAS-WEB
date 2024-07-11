document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('telefono').value;
    const fechaNacimiento = document.getElementById('fechaNacimiento').value;
    const comentarios = document.getElementById('comentarios').value;

    if (!emailRegex.test(email)) {
        alert('Por favor, introduce un email válido.');
        return;
    }

    if (!telefonoRegex.test(telefono)) {
        alert('Por favor, introduce un número de teléfono válido (9 dígitos sin espacios ni guiones).');
        return;
    }

    if (!isAdult(fechaNacimiento)) {
        alert('Debes ser mayor de edad para enviar este formulario.');
        return;
    }

    mostrarResultados(nombre, email, telefono, fechaNacimiento, comentarios);
});

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const telefonoRegex = /^[0-9]{9}$/;

function isAdult(fechaNacimiento) {
    const hoy = new Date();
    const fechaNac = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - fechaNac.getFullYear();
    const mes = hoy.getMonth() - fechaNac.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }

    return edad >= 18;
}

function mostrarResultados(nombre, email, telefono, fechaNacimiento, comentarios) {
    const resultadosHTML = `
        <h2>Resultados del Formulario</h2>
        <p><strong>Nombre:</strong> ${nombre}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Teléfono:</strong> ${telefono}</p>
        <p><strong>Fecha de Nacimiento:</strong> ${fechaNacimiento}</p>
        <p><strong>Comentarios:</strong> ${comentarios}</p>
    `;

    document.getElementById('resultados').innerHTML = resultadosHTML;
}
