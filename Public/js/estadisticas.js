function cerrarSesion() {
    window.location.href = "../logout.php";
}

fetch("../index.php?option=estadisticas")
.then(response => response.json())
.then(data => {
    document.getElementById("totalAdopciones").innerText  = data.adopciones;
    document.getElementById("totalDonaciones").innerText  = data.donaciones;
    document.getElementById("totalVoluntarios").innerText = data.voluntarios;
    document.getElementById("totalEventos").innerText     = data.eventos;
})
.catch(error => console.log(error));