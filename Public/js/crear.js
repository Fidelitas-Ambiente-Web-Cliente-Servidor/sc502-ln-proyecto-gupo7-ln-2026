function cerrarSesion() {
    window.location.href = "../logout.php";
}

document.getElementById("eventoForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let titulo      = document.getElementById("titulo").value;
    let descripcion = document.getElementById("descripcion").value;
    let fecha       = document.getElementById("fecha").value;

    fetch("../index.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "option=evento" +
              "&titulo=" + encodeURIComponent(titulo) +
              "&descripcion=" + encodeURIComponent(descripcion) +
              "&fecha=" + encodeURIComponent(fecha)
    })
    .then(response => response.json())
    .then(data => {
        if (data.response == "00") {
            alert(data.message);
            window.location.href = "eventos.html";
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.log(error));
});