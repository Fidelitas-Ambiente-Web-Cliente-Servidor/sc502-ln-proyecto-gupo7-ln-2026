function cerrarSesion() {
    window.location.href = "../logout.php";
}

document.getElementById("eventoForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let titulo      = document.getElementById("titulo").value;
    let descripcion = document.getElementById("descripcion").value;
    let fecha       = document.getElementById("fecha").value;

    fetch("../controllers/EventoController.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "accion=guardar" +
              "&titulo=" + encodeURIComponent(titulo) +
              "&descripcion=" + encodeURIComponent(descripcion) +
              "&fecha=" + encodeURIComponent(fecha)
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            alert(data.mensaje);
            window.location.href = "eventos.html";
        } else {
            alert(data.mensaje);
        }
    })
    .catch(error => console.log(error));
});