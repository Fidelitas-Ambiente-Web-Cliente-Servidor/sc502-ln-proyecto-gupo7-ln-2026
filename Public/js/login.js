document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let email    = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    fetch("../login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password)
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            alert("Bienvenida " + data.nombre);
            window.location.href = "principal.html";
        } else {
            alert(data.mensaje);
        }
    })
    .catch(error => console.log(error));
});