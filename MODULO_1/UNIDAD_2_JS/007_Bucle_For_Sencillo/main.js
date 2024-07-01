for (let i = 0; i <= 4; i++) {
    document.write(i + "<br>");
}

document.write("<hr>");

for (let y = 0; y <= 4; y++) {
    if (y === 2) {
        break;
    }
    document.write(y + "<br>");
}

document.write("<hr>");

for (let i = 2; i <= 20; i += 2) {
    document.write(`${i} `);
}

document.write("<hr>");


let suma = 0;

for (let n = 1; n <= 100; n++) {
  suma += n;
}
document.write("La suma de los primeros 100 números naturales es: " + suma);
document.write("<br>");

document.write("<hr>");

for (i=5; i>0; i--){
    for (j=i; j>0; j--) {
        document.write('*')
    }
    document.write("<br>")
}

document.write("<hr>");
