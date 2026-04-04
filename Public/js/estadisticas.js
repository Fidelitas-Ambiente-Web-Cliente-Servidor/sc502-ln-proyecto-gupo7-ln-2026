function cerrarSesion() {
    window.location.href = "../logout.php";
}

fetch("../controllers/EventoController.php?accion=listar")
.then(response => response.json())
.then(data => {
    document.getElementById("totalEventos").innerText =
        "Total de eventos registrados: " + data.length;
})
.catch(error => console.log(error));