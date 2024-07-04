const elemento = document.getElementById('lista');
let ciudades =[]

for (i = 0; i<4; i++){
    let ciudad = prompt ("Introduce el nombre de la ciudad " + i)
    if (!ciudad || ciudad == undefined){
        i--;
        continue;
    }
    ciudades.push(ciudad)
    console.log(ciudades)
    elemento.innerHTML = elemento.innerHTML + `<li>${ciudad}</li>`
}