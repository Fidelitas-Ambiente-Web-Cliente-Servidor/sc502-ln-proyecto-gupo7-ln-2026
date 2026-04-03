document.querySelector(".form-donaciones_monetarias button").addEventListener("click", (e) => {
  e.preventDefault(); 
  let valido = true;

  let nombre = document.getElementById("nombre").value.trim();
  let monto = document.getElementById("monto").value.trim();
  let fecha = document.getElementById("fecha").value;
  let tipoPago = document.getElementById("tipoPago").value;
  let numeroTarjeta = document.getElementById("numeroTarjeta") ? document.getElementById("numeroTarjeta").value.trim() : "";

  document.getElementById("errorNombre").textContent = "";
  document.getElementById("errorMonto").textContent = "";
  document.getElementById("errorFecha").textContent = "";
  document.getElementById("errorTipoPago").textContent = "";
  if (document.getElementById("errorTarjeta")) {
    document.getElementById("errorTarjeta").textContent = "";
  }


  if (nombre === "") {
    document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
    valido = false;
  }


  if (monto === "" || isNaN(monto) || parseFloat(monto) <= 0) {
    document.getElementById("errorMonto").textContent = "Debe ingresar un monto válido mayor a 0.";
    valido = false;
  }

  if (!tipoPago) {
    document.getElementById("errorTipoPago").textContent = "Debe seleccionar un método de pago.";
    valido = false;
  }

  if (tipoPago === "tarjeta") {
    if (numeroTarjeta === "") {
      document.getElementById("errorTarjeta").textContent = "Debe ingresar el número de tarjeta.";
      valido = false;
    } else if (!/^\d{16}$/.test(numeroTarjeta.replace(/\s|-/g, ""))) {
      document.getElementById("errorTarjeta").textContent = "El número de tarjeta debe tener 16 dígitos.";
      valido = false;
    }
  }

  if (valido) {
    setTimeout(() => {
      let mensajeFinal = document.getElementById("mensajeFinal");
      if (!mensajeFinal) {
        mensajeFinal = document.createElement("div");
        mensajeFinal.id = "mensajeFinal";
        document.querySelector(".form-donaciones_monetarias").appendChild(mensajeFinal);
      }

      mensajeFinal.textContent = "Enviando datos... Donación registrada correctamente.";
      mensajeFinal.className = "Exito";

      setTimeout(() => {
        mensajeFinal.textContent = "Datos enviados al sistema de donaciones.";
      }, 2000);
    }, 2000);
  }
});


const tipoPagoSelect = document.getElementById("tipoPago");
const campoTarjeta = document.getElementById("campoTarjeta");

tipoPagoSelect.addEventListener("change", function() {
  if (this.value === "tarjeta") {
    campoTarjeta.style.display = "block";
  } else {
    campoTarjeta.style.display = "none";
  }


  

});