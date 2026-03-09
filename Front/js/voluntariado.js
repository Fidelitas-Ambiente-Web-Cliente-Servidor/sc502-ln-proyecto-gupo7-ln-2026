let boton = document.querySelector(".form-voluntariado button");

if(boton){

boton.addEventListener("click", (e) => {

e.preventDefault();

let valido = true;

let nombre = document.getElementById("nombre").value.trim();
let telefono = document.getElementById("telefono").value.trim();
let correo = document.getElementById("correo").value.trim();

document.getElementById("errorNombre").textContent="";
document.getElementById("errorTelefono").textContent="";
document.getElementById("errorCorreo").textContent="";

if(nombre===""){
document.getElementById("errorNombre").textContent="El nombre es obligatorio.";
valido=false;
}

if(telefono===""){
document.getElementById("errorTelefono").textContent="El telefono es obligatorio.";
valido=false;
}

if(correo===""){
document.getElementById("errorCorreo").textContent="El correo es obligatorio.";
valido=false;
}

if(valido){

setTimeout(()=>{

let mensajeFinal=document.getElementById("mensajeFinal");

if(!mensajeFinal){
mensajeFinal=document.createElement("div");
mensajeFinal.id="mensajeFinal";
document.querySelector(".form-voluntariado").appendChild(mensajeFinal);
}

mensajeFinal.textContent="Enviando datos... Registro completado.";
mensajeFinal.className="Exito";

setTimeout(()=>{
mensajeFinal.textContent="Datos enviados al sistema de voluntarios.";
},2000);

},2000);

}

});

}


// Interacción para las imágenes de voluntariado

let imagenes = document.querySelectorAll(".card img");

imagenes.forEach(function(img){

img.addEventListener("mouseenter", function(){
img.style.transform = "scale(1.08)";
});

img.addEventListener("mouseleave", function(){
img.style.transform = "scale(1)";
});

});