function cerrarSesion() {
    window.location.href = "../../logout.php";
}

fetch("../../controllers/EventoController.php?accion=listar")
.then(response => response.json())
.then(data => {
    let contenedor = document.getElementById("listaEventos");

    if (data.length === 0) {
        contenedor.innerHTML = "<p>No hay eventos registrados.</p>";
    } else {
        data.forEach(function(evento) {
            contenedor.innerHTML += "<div class='card p-3 mb-3'>" +
                "<h5>" + evento.titulo + "</h5>" +
                "<p>" + evento.descripcion + "</p>" +
                "<small>" + evento.fecha + "</small>" +
                "</div>";
        });
    }
})
.catch(error => console.log(error));