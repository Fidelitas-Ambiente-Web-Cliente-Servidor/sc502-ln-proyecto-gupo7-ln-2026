function cerrarSesion() {
    window.location.href = "../logout.php";
}

fetch("../index.php?option=eventos")
.then(response => response.json())
.then(data => {
    let contenedor = document.getElementById("listaEventos");

    if (data.length === 0) {
        contenedor.innerHTML = "<p class='sin-eventos'>No hay eventos registrados.</p>";
    } else {
        data.forEach(function(evento) {
            contenedor.innerHTML +=
                "<div class='evento-card'>" +
                    "<h5>📌 " + evento.titulo + "</h5>" +
                    "<p>" + evento.descripcion + "</p>" +
                    "<span class='fecha'>📆 " + evento.fecha + "</span>" +
                "</div>";
        });
    }
})
.catch(error => console.log(error));