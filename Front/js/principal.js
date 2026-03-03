// Verificar sesión
let sesion = localStorage.getItem("sesionActiva");

if(!sesion){
    window.location.href = "login.html";
}

// Función cerrar sesión
function cerrarSesion(){
    localStorage.removeItem("sesionActiva");
    window.location.href = "login.html";
}