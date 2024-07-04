const meses = [
  "Enero", "Febrero", "Marzo", "Abril", 
  "Mayo", "Junio", "Julio", "Agosto", 
  "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

let numero = prompt("Ingresa un número del 1 al 12:");

numero = parseInt(numero);

if (numero >= 1 && numero <= 12) {
  let nombreDelMes = meses[numero - 1];
  document.write(`El nombre del mes correspondiente al número ${numero} es: ${nombreDelMes}`);
} else {
  document.write("Número de mes inválido. Por favor ingresa un número del 1 al 12.");
}
