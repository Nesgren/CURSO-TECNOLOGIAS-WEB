const agregar = document.getElementById("agregar");
const sortear = document.getElementById("sortear");
const nombre = document.getElementById("nombre");
const lista = document.getElementById("lista");
const mensaje = document.getElementById("mensaje");

let personas = [];

agregar.addEventListener("click", function () {
    const name = nombre.value.trim();
    if (name) {
        personas.push(name);
        const posibleGanador = document.createElement("li");
        posibleGanador.textContent = name;
        lista.appendChild(posibleGanador);
        nombre.value = "";
    }
});

sortear.addEventListener("click", function () {
    if (personas.length === 0) {
        mensaje.textContent = "No hay concursantes en la lista.";
        return;
    }
    const numeroGanador = Math.floor(Math.random() * personas.length);
    const ganador = personas[numeroGanador];

    const items = lista.getElementsByTagName("li");

    items[numeroGanador].classList.add("ganador");
    
    mensaje.textContent = `¡El ganador es: ${ganador}! Felicidades!`;
});
