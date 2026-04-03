document.querySelector(".form-donaciones_monetarias button").addEventListener("click", (e) => {
  e.preventDefault(); 
  let valido = true;

  let nombre = document.getElementById("nombre").value.trim();
  let monto = document.getElementById("monto").value.trim();
  let fecha = document.getElementById("fecha").value;
  let tipoDonacion = document.getElementById("tipoDonacion").value;
  let donativo = document.getElementById("Donativo") ? document.getElementById("Donativo").value.trim() : "";

  // Limpiar errores
  document.getElementById("errorNombre").textContent = "";
  document.getElementById("errorMonto").textContent = "";
  document.getElementById("errorFecha").textContent = "";
  document.getElementById("errortipoDonacion").textContent = "";
  if (document.getElementById("errorTarjeta")) {
    document.getElementById("errorTarjeta").textContent = "";
  }

  // Validaciones
  if (nombre === "") {
    document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
    valido = false;
  }

  if (monto === "" || isNaN(monto) || parseFloat(monto) <= 0) {
    document.getElementById("errorMonto").textContent = "Debe ingresar un monto válido mayor a 0.";
    valido = false;
  }

  if (!tipoDonacion) {
    document.getElementById("errortipoDonacion").textContent = "Debe seleccionar un tipo de donación.";
    valido = false;
  }

  if (tipoDonacion === "Otro") {
    if (donativo === "") {
      document.getElementById("errorTarjeta").textContent = "Debe especificar el donativo.";
      valido = false;
    }
  }

  // Mensaje final
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

// Mostrar/ocultar campo "Otro"
const tipoDonacionSelect = document.getElementById("tipoDonacion");
const campoOtro = document.getElementById("campoOtro");

tipoDonacionSelect.addEventListener("change", function() {
  if (this.value === "Otro") {
    campoOtro.style.display = "block";
  } else {
    campoOtro.style.display = "none";
  }
});