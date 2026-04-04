document.getElementById("btnLogin").addEventListener("click", function() {

    let email    = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Todos los campos son obligatorios.");
        return;
    }

    fetch("../index.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "option=login" +
              "&email=" + encodeURIComponent(email) +
              "&password=" + encodeURIComponent(password)
    })
    .then(response => response.json())
    .then(data => {
        if (data.response == "00") {
            alert("Bienvenida " + data.nombre);
            window.location.href = "principal.html";
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.log(error));
});