function calcularDescuento() {
    let precioOriginal = document.getElementById('precio').value;
    let porcentajeDescuento = document.getElementById('descuento').value;
    let precioFinal = precioOriginal - (precioOriginal * (porcentajeDescuento / 100));
    document.getElementById('resultado').textContent = "El precio final del producto después de aplicar un descuento del " + porcentajeDescuento + "% es: " + precioFinal + " euros.";
}
