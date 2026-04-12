function cerrarSesion() {
    window.location.href = "../logout.php";
}

fetch("../index.php?option=eventos")
.then(response => response.json())
.then(data => {
    document.getElementById("totalEventos").innerText =
        "Total de eventos registrados: " + data.length;
})
.catch(error => console.log(error));