if(!localStorage.getItem("sesionActiva")){
    window.location.href = "login.html";
}

let eventos = JSON.parse(localStorage.getItem("eventos")) || [];

document.getElementById("totalEventos").innerText =
    "Total de eventos registrados: " + eventos.length;

function cerrarSesion(){
    localStorage.removeItem("sesionActiva");
    window.location.href = "login.html";
}