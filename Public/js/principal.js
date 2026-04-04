console.log("Proyecto Refugio - Grupo 7");

document.addEventListener("DOMContentLoaded", function () {

    fetch("../sesion.php")
    .then(response => response.json())
    .then(data => {
        if (!data.ok) {
            window.location.href = "login.html";
        }
    });

    let enlacesMenu = document.querySelectorAll(".navbar-nav .nav-link");
    enlacesMenu.forEach(function(enlace) {
        enlace.addEventListener("mouseover", function () {
            enlace.style.color = "#f4b400";
        });
        enlace.addEventListener("mouseleave", function () {
            enlace.style.color = "white";
        });
    });

});

function cerrarSesion() {
    window.location.href = "../logout.php";
}