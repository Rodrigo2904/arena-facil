document
.getElementById("cadastroForm")
.addEventListener("submit", async function(e) {

    e.preventDefault();

    const nome =
    document.getElementById("nome").value;

    const email =
    document.getElementById("email").value;

    const senha =
    document.getElementById("senha").value;

    const tipo =
    document.getElementById("tipo").value;

    const resposta = await fetch(
        "../api/usuarios/cadastrar.php",
        {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                nome,
                email,
                senha,
                tipo
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

        setTimeout(() => {

            window.location.href =
            "login.html";

        }, 2000);

    } else {

        mensagem.innerHTML =
        `<div class="alert alert-danger">
            ${dados.message}
        </div>`;
    }

});
