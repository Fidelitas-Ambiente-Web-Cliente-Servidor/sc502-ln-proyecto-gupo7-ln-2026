document.querySelector(".form-adopcion button").addEventListener("click", (e) => {
  let valido = true;

  // obtener los valores
  let nombre = document.getElementById("nombre").value.trim();
  let mascota = document.getElementById("mascota").value.trim();
  let fecha = document.getElementById("fecha").value;

  // Limpiar mensajes
  document.getElementById("errorNombre").textContent = "";
  document.getElementById("errormascota").textContent = "";
  document.getElementById("errorFecha").textContent = "";

  // Validación nombre
  if (nombre === "") {
    document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
    valido = false;
  }

  // Validación mascota
  if (mascota === "") {
    document.getElementById("errormascota").textContent = "Debe ingresar la mascota seleccionada.";
    valido = false;
  }

  // Validación fecha
  let hoy = new Date().toISOString().split("T")[0];
  if (!fecha) {
    document.getElementById("errorFecha").textContent = "Debe seleccionar una fecha.";
    valido = false;
  } else if (fecha < hoy) {
    document.getElementById("errorFecha").textContent = "La fecha no puede ser anterior a hoy.";
    valido = false;
  }

  // Mensaje final
  if (valido) {
    setTimeout(() => {
      let mensajeFinal = document.getElementById("mensajeFinal");
      if (!mensajeFinal) {
        mensajeFinal = document.createElement("div");
        mensajeFinal.id = "mensajeFinal";
        document.querySelector(".form-adopcion").appendChild(mensajeFinal);
      }

      mensajeFinal.textContent = "Enviando datos... Adopción registrada correctamente.";
      mensajeFinal.className = "Exito";

      setTimeout(() => {
        mensajeFinal.textContent = "Datos enviados al sistema de adopciones.";
      }, 2000);
    }, 2000);
  }
});