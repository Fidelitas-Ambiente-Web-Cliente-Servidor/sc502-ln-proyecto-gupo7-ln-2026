if(!localStorage.getItem("sesionActiva")){
    window.location.href = "login.html";
}

document.getElementById("eventoForm").addEventListener("submit", function(e){
    e.preventDefault();

    let titulo = document.getElementById("titulo").value;
    let descripcion = document.getElementById("descripcion").value;
    let fecha = document.getElementById("fecha").value;

    let eventos = JSON.parse(localStorage.getItem("eventos")) || [];

    eventos.push({
        titulo: titulo,
        descripcion: descripcion,
        fecha: fecha
    });

    localStorage.setItem("eventos", JSON.stringify(eventos));

    alert("Evento guardado correctamente");

    window.location.href = "eventos.html";
});

function cerrarSesion(){
    localStorage.removeItem("sesionActiva");
    window.location.href = "login.html";
}