// Protección
if(!localStorage.getItem("sesionActiva")){
    window.location.href = "login.html";
}

// Mostrar eventos guardados
let eventos = JSON.parse(localStorage.getItem("eventos")) || [];
let contenedor = document.getElementById("listaEventos");

if(eventos.length === 0){
    contenedor.innerHTML = "<p>No hay eventos registrados.</p>";
}else{
    eventos.forEach((evento, index) => {
        contenedor.innerHTML += `
            <div class="card p-3 mb-3">
                <h5>${evento.titulo}</h5>
                <p>${evento.descripcion}</p>
                <small>${evento.fecha}</small>
            </div>
        `;
    });
}

function cerrarSesion(){
    localStorage.removeItem("sesionActiva");
    window.location.href = "login.html";
}