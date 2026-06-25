document
.getElementById("loginForm")
.addEventListener("submit", async function(e) {

    e.preventDefault();

    const email =
    document.getElementById("email").value;

    const senha =
    document.getElementById("senha").value;

    const resposta = await fetch(
        "/arena-facil/api/usuarios/login.php",
        {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email,
                senha
            })
        }
    );

    const dados = await resposta.json();

    const mensagem =
    document.getElementById("mensagem");

    if (dados.status === "success") {

        mensagem.innerHTML =
        `<div class="alert alert-success">
            ${dados.message}
        </div>`;

        if (dados.tipo === "proprietario") {

            window.location.href =
            "/arena-facil/frontend/dashboard_proprietario.html";

        } else {

            window.location.href =
            "/arena-facil/frontend/dashboard_cliente.html";

        }

    } else {

        mensagem.innerHTML =
        `<div class="alert alert-danger">
            ${dados.message}
        </div>`;

    }

});
