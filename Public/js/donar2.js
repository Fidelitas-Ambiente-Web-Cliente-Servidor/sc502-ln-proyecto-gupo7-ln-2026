function cerrarSesion() {
    window.location.href = "../logout.php";
}

document.addEventListener("DOMContentLoaded", function() {
    const fechaInput = document.getElementById("fecha");
    const hoy = new Date().toISOString().split("T")[0];
    fechaInput.value = hoy;
    fechaInput.min = hoy;
});

document.getElementById("tipoPago").addEventListener("change", function() {
    let campoTarjeta = document.getElementById("campoTarjeta");
    if (this.value === "tarjeta") {
        campoTarjeta.style.display = "block";
    } else {
        campoTarjeta.style.display = "none";
    }
});

document.getElementById("btnDonar").addEventListener("click", function() {
    let valido = true;

    let nombre   = document.getElementById("nombre").value.trim();
    let monto    = document.getElementById("monto").value.trim();
    let fecha    = document.getElementById("fecha").value;
    let tipoPago = document.getElementById("tipoPago").value;

    document.getElementById("errorNombre").textContent   = "";
    document.getElementById("errorMonto").textContent    = "";
    document.getElementById("errorFecha").textContent    = "";
    document.getElementById("errorTipoPago").textContent = "";

    if (nombre === "") {
        document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
        valido = false;
    }

    if (monto === "" || isNaN(monto) || parseFloat(monto) <= 0) {
        document.getElementById("errorMonto").textContent = "Debe ingresar un monto valido.";
        valido = false;
    }

    if (!fecha) {
        document.getElementById("errorFecha").textContent = "Debe seleccionar una fecha.";
        valido = false;
    }

    if (!tipoPago) {
        document.getElementById("errorTipoPago").textContent = "Debe seleccionar un tipo de pago.";
        valido = false;
    }

    if (valido) {
        fetch("../index.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "option=donacion_monetaria" +
                  "&nombre=" + encodeURIComponent(nombre) +
                  "&monto=" + encodeURIComponent(monto) +
                  "&fecha=" + encodeURIComponent(fecha) +
                  "&tipo_pago=" + encodeURIComponent(tipoPago)
        })
        .then(response => response.json())
        .then(data => {
            if (data.response == "00") {
                alert(data.message);
                document.getElementById("nombre").value   = "";
                document.getElementById("monto").value    = "";
                document.getElementById("tipoPago").value = "";
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.log(error));
    }
});