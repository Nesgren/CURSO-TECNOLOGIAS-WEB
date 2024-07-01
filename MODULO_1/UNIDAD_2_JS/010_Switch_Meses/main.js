function mostrarMes() {
    // Obtener el valor del número ingresado por el usuario
    var numero = parseInt(document.getElementById('numeroMes').value);

    // Variable para almacenar el nombre del mes
    var nombreMes;

    // Utilizar switch para asignar el nombre del mes según el número ingresado
    switch (numero) {
        case 1:
            nombreMes = "Enero";
            break;
        case 2:
            nombreMes = "Febrero";
            break;
        case 3:
            nombreMes = "Marzo";
            break;
        case 4:
            nombreMes = "Abril";
            break;
        case 5:
            nombreMes = "Mayo";
            break;
        case 6:
            nombreMes = "Junio";
            break;
        case 7:
            nombreMes = "Julio";
            break;
        case 8:
            nombreMes = "Agosto";
            break;
        case 9:
            nombreMes = "Septiembre";
            break;
        case 10:
            nombreMes = "Octubre";
            break;
        case 11:
            nombreMes = "Noviembre";
            break;
        case 12:
            nombreMes = "Diciembre";
            break;
        default:
            // Si el número no está en el rango del 1 al 12, mostrar mensaje de error
            document.getElementById('resultado').textContent = "Número inválido. Ingresa un número del 1 al 12.";
            return;
    }

    // Mostrar el resultado al usuario
    document.getElementById('resultado').textContent =  nombreMes;
}
