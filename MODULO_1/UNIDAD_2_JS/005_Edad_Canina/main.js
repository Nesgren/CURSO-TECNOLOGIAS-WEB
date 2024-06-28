let edadHumana = parseInt(prompt("Introduce la edad de tu perro"));

if (isNaN(edadHumana)) {
    alert("No has ingresado un número");
} else {
    document.write(`Número introducido: ${edadHumana}<br>`);
    let edadPerruna = edadHumana * 7;
    document.write(`La edad real de tu perro es: ${edadPerruna}`);
}
