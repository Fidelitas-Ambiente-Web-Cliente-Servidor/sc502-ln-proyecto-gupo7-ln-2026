function cerrarSesion() {
    window.location.href = "../../logout.php";
}

let boton = document.querySelector(".form-voluntariado button");

if (boton) {
    boton.addEventListener("click", (e) => {
        e.preventDefault();
        let valido = true;

        let nombre    = document.getElementById("nombre").value.trim();
        let telefono  = document.getElementById("telefono").value.trim();
        let correo    = document.getElementById("correo").value.trim();
        let tipo      = document.querySelector(".form-voluntariado h2") ? document.querySelector(".form-voluntariado h2").textContent : "General";

        document.getElementById("errorNombre").textContent   = "";
        document.getElementById("errorTelefono").textContent = "";
        document.getElementById("errorCorreo").textContent   = "";

        if (nombre === "") {
            document.getElementById("errorNombre").textContent = "El nombre es obligatorio.";
            valido = false;
        }

        if (telefono === "") {
            document.getElementById("errorTelefono").textContent = "El telefono es obligatorio.";
            valido = false;
        }

        if (correo === "") {
            document.getElementById("errorCorreo").textContent = "El correo es obligatorio.";
            valido = false;
        }

        if (valido) {
            fetch("../../controllers/VoluntarioController.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "nombre=" + encodeURIComponent(nombre) +
                      "&telefono=" + encodeURIComponent(telefono) +
                      "&correo=" + encodeURIComponent(correo) +
                      "&tipo_voluntariado=" + encodeURIComponent(tipo)
            })
            .then(response => response.json())
            .then(data => {
                if (data.ok) {
                    alert(data.mensaje);
                    document.getElementById("nombre").value   = "";
                    document.getElementById("telefono").value = "";
                    document.getElementById("correo").value   = "";
                } else {
                    alert(data.mensaje);
                }
            })
            .catch(error => console.log(error));
        }
    });
}

let imagenes = document.querySelectorAll(".card img");
imagenes.forEach(function(img) {
    img.addEventListener("mouseenter", function() {
        img.style.transform = "scale(1.08)";
    });
    img.addEventListener("mouseleave", function() {
        img.style.transform = "scale(1)";
    });
});