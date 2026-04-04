document.getElementById("btnRegistrar").addEventListener("click", function(e) {

    let nombre   = document.querySelector("input[name='nombre']").value;
    let email    = document.querySelector("input[name='email']").value;
    let password = document.querySelector("input[name='password']").value;
    let confirm  = document.getElementById("confirmPassword").value;

    if (nombre === "" || email === "" || password === "") {
        alert("Todos los campos son obligatorios.");
        return;
    }

    if (password !== confirm) {
        alert("Las contrasenas no coinciden.");
        return;
    }

    fetch("../index.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "option=registro" +
              "&nombre=" + encodeURIComponent(nombre) +
              "&email=" + encodeURIComponent(email) +
              "&password=" + encodeURIComponent(password) +
              "&confirm=" + encodeURIComponent(confirm)
    })
    .then(response => response.json())
    .then(data => {
        if (data.response == "00") {
            alert(data.message);
            window.location.href = "login.html";
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.log(error));
});