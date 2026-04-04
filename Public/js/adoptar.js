function cerrarSesion() {
    window.location.href = "../logout.php";
}

document.getElementById("btnAgendar").addEventListener("click", function() {
    let valido = true;

    let nombre  = document.getElementById("nombre").value.trim();
    let mascota = document.getElementById("mascota").value.trim();
    let fecha   = document.getElementById("fecha").value;

    document.getElementById("errorNombre").textContent  = "";
    document.getElementById("errormascota").textContent = "";
    document.getElementById("errorFecha").textContent   = "";

    if (nombre === "") {
        document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
        valido = false;
    }

    if (mascota === "") {
        document.getElementById("errormascota").textContent = "Debe seleccionar una mascota.";
        valido = false;
    }

    let hoy = new Date().toISOString().split("T")[0];
    if (!fecha) {
        document.getElementById("errorFecha").textContent = "Debe seleccionar una fecha.";
        valido = false;
    } else if (fecha < hoy) {
        document.getElementById("errorFecha").textContent = "La fecha no puede ser anterior a hoy.";
        valido = false;
    }

    if (valido) {
        fetch("../index.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "option=adopcion" +
                  "&nombre=" + encodeURIComponent(nombre) +
                  "&mascota=" + encodeURIComponent(mascota) +
                  "&fecha=" + encodeURIComponent(fecha)
        })
        .then(response => response.json())
        .then(data => {
            if (data.response == "00") {
                alert(data.message);
                document.getElementById("nombre").value  = "";
                document.getElementById("mascota").value = "";
                document.getElementById("fecha").value   = "";
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.log(error));
    }
});