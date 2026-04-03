document.querySelector(".form-donaciones_monetarias button").addEventListener("click", (e) => {
    e.preventDefault();
    let valido = true;

    let nombre    = document.getElementById("nombre").value.trim();
    let monto     = document.getElementById("monto").value.trim();
    let fecha     = document.getElementById("fecha").value;
    let tipoPago  = document.getElementById("tipoPago").value;
    let numeroTarjeta = document.getElementById("numeroTarjeta") ? document.getElementById("numeroTarjeta").value.trim() : "";

    document.getElementById("errorNombre").textContent   = "";
    document.getElementById("errorMonto").textContent    = "";
    document.getElementById("errorFecha").textContent    = "";
    document.getElementById("errorTipoPago").textContent = "";
    if (document.getElementById("errorTarjeta")) {
        document.getElementById("errorTarjeta").textContent = "";
    }

    if (nombre === "") {
        document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
        valido = false;
    }

    if (monto === "" || isNaN(monto) || parseFloat(monto) <= 0) {
        document.getElementById("errorMonto").textContent = "Debe ingresar un monto valido mayor a 0.";
        valido = false;
    }

    if (!tipoPago) {
        document.getElementById("errorTipoPago").textContent = "Debe seleccionar un metodo de pago.";
        valido = false;
    }

    if (tipoPago === "tarjeta") {
        if (numeroTarjeta === "") {
            document.getElementById("errorTarjeta").textContent = "Debe ingresar el numero de tarjeta.";
            valido = false;
        } else if (!/^\d{16}$/.test(numeroTarjeta.replace(/\s|-/g, ""))) {
            document.getElementById("errorTarjeta").textContent = "El numero de tarjeta debe tener 16 digitos.";
            valido = false;
        }
    }

    if (valido) {
        fetch("../../controllers/DonacionController.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "accion=monetaria" +
                  "&nombre=" + encodeURIComponent(nombre) +
                  "&monto=" + encodeURIComponent(monto) +
                  "&fecha=" + encodeURIComponent(fecha) +
                  "&tipo_pago=" + encodeURIComponent(tipoPago)
        })
        .then(response => response.json())
        .then(data => {
            if (data.ok) {
                alert(data.mensaje);
                document.getElementById("nombre").value  = "";
                document.getElementById("monto").value   = "";
                document.getElementById("tipoPago").value = "";
            } else {
                alert(data.mensaje);
            }
        })
        .catch(error => console.log(error));
    }
});

const tipoPagoSelect = document.getElementById("tipoPago");
const campoTarjeta   = document.getElementById("campoTarjeta");

tipoPagoSelect.addEventListener("change", function() {
    if (this.value === "tarjeta") {
        campoTarjeta.style.display = "block";
    } else {
        campoTarjeta.style.display = "none";
    }
});