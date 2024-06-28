let num1 = parseInt(prompt("Introduce un número"));
if (isNaN(num1)) {
    alert("No has ingresado un número");
} else {
    document.write(`Número introducido: ${num1}<br>`);
}

let num2 = parseInt(prompt("Introduce otro número"));
if (isNaN(num2)) {
    alert("No has ingresado un número");
} else {
    document.write(`Número introducido: ${num2}<br>`);
}

if (!isNaN(num1) && !isNaN(num2)) {
    let suma = num1 + num2;
    document.write(`Suma: ${suma}`);
}
