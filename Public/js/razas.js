let urlBase = "https://dog.ceo/api/";

function mostrarRazas(raza) {
    let resultado = document.getElementById("resultadoRazas");
    resultado.innerHTML = "<p class='text-center'>Cargando...</p>";

    let endpoint = raza ? "breed/" + raza + "/images/random/6" : "breeds/image/random/6";

    fetch(urlBase + endpoint)
        .then(response => response.json())
        .then(data => {
            if (data.status !== "success") {
                resultado.innerHTML = "<p class='text-center text-danger'>Raza no encontrada.</p>";
                return;
            }

            let html = "";
            data.message.forEach(function(img) {
                let nombreRaza = raza ? raza : img.split("/")[4];
                html += "<div class='col-md-4 mb-4'>" +
                    "<div class='card h-100'>" +
                    "<img src='" + img + "' class='card-img-top' style='height:200px; object-fit:cover;'>" +
                    "<div class='card-body text-center'>" +
                    "<h5 class='card-title text-capitalize'>" + nombreRaza + "</h5>" +
                    "<p class='card-text'>Disponible para adopcion</p>" +
                    "<a href='adoptar2.html' class='btn btn-success'>Adoptar</a>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
            });

            resultado.innerHTML = html;
        })
        .catch(error => {
            resultado.innerHTML = "<p class='text-center text-danger'>Error al conectar con la API.</p>";
            console.log(error);
        });
}


document.addEventListener("DOMContentLoaded", function() {
    mostrarRazas("");
});


document.getElementById("btnBuscar").addEventListener("click", function() {
    let raza = document.getElementById("buscarRaza").value.trim().toLowerCase();
    if (raza !== "") {
        mostrarRazas(raza);
    } else {
        alert("Ingrese una raza para buscar.");
    }
});


document.getElementById("btnTodas").addEventListener("click", function() {
    document.getElementById("buscarRaza").value = "";
    mostrarRazas("");
});