let matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

document.write(matriz[0][2] + ", " + matriz[1][1]);
document.write("<hr>");

matriz.forEach(primario => {

    primario.forEach(secundario => {
        document.write(secundario + ",")
    })
document.write("<br>")
})

document.write("<hr>");

matriz.forEach(primario => {

    primario.forEach(secundario => {
        if (secundario % 3 == 0)
            secundario = "m";
        document.write(secundario)
    })
    document.write("<br>")
})