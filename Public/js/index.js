console.log("Proyecto Refugio - Grupo 7");

document.addEventListener("DOMContentLoaded", function () {


    // Interacción en el menú   

    let enlacesMenu = document.querySelectorAll(".menu ul li a");

    for (let i = 0; i < enlacesMenu.length; i++) {

        enlacesMenu[i].addEventListener("mouseover", function () {
            enlacesMenu[i].style.color = "#f4b400";
        });

        enlacesMenu[i].addEventListener("mouseleave", function () {
            enlacesMenu[i].style.color = "white";
        });

    }



});