document.getElementById("registroForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let nombre = document.querySelector("input[name='nombre']").value;
    let email = document.querySelector("input[name='email']").value;
    let password = document.querySelector("input[name='password']").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    if(password !== confirmPassword){
        alert("Las contraseñas no coinciden");
        return;
    }

    let usuario = {
        nombre: nombre,
        email: email,
        password: password
    };

    localStorage.setItem("usuario", JSON.stringify(usuario));

    alert("Registro exitoso. Ahora inicia sesión.");

    window.location.href = "login.html";
});