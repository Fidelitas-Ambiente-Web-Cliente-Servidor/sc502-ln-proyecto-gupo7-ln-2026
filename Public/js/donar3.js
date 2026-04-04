document.querySelector(".form-donaciones_monetarias button").addEventListener("click", (e) => {
    e.preventDefault();
    let valido = true;

    let nombre       = document.getElementById("nombre").value.trim();
    let cantidad     = document.getElementById("monto").value.trim();
    let fecha        = document.getElementById("fecha").value;
    let tipoDonacion = document.getElementById("tipoDonacion").value;
    let donativo     = document.getElementById("Donativo") ? document.getElementById("Donativo").value.trim() : "";

    document.getElementById("errorNombre").textContent       = "";
    document.getElementById("errorMonto").textContent        = "";
    document.getElementById("errortipoDonacion").textContent = "";
    if (document.getElementById("errorTarjeta")) {
        document.getElementById("errorTarjeta").textContent = "";
    }

    if (nombre === "") {
        document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
        valido = false;
    }

    if (cantidad === "" || isNaN(cantidad) || parseFloat(cantidad) <= 0) {
        document.getElementById("errorMonto").textContent = "Debe ingresar una cantidad valida.";
        valido = false;
    }

    if (!tipoDonacion) {
        document.getElementById("errortipoDonacion").textContent = "Debe seleccionar un tipo de donacion.";
        valido = false;
    }

    if (tipoDonacion === "Otro" && donativo === "") {
        document.getElementById("errorTarjeta").textContent = "Debe especificar el donativo.";
        valido = false;
    }

    if (valido) {
        let tipoFinal = tipoDonacion === "Otro" ? donativo : tipoDonacion;

        fetch("../controllers/DonacionController.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "accion=otro" +
                  "&nombre=" + encodeURIComponent(nombre) +
                  "&cantidad=" + encodeURIComponent(cantidad) +
                  "&tipo_donacion=" + encodeURIComponent(tipoFinal) +
                  "&fecha=" + encodeURIComponent(fecha)
        })
        .then(response => response.json())
        .then(data => {
            if (data.ok) {
                alert(data.mensaje);
                document.getElementById("nombre").value       = "";
                document.getElementById("monto").value        = "";
                document.getElementById("tipoDonacion").value = "";
            } else {
                alert(data.mensaje);
            }
        })
        .catch(error => console.log(error));
    }
});

const tipoDonacionSelect = document.getElementById("tipoDonacion");
const campoOtro          = document.getElementById("campoOtro");

tipoDonacionSelect.addEventListener("change", function() {
    if (this.value === "Otro") {
        campoOtro.style.display = "block";
    } else {
        campoOtro.style.display = "none";
    }
});