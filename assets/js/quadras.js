document
.getElementById("quadraForm")
.addEventListener("submit", async function(e) {

    e.preventDefault();

    const nome =
    document.getElementById("nome").value;

    const tipo =
    document.getElementById("tipo").value;

    const preco =
    document.getElementById("preco_hora").value;

    const resposta = await fetch(
        "../api/quadras/salvar.php",
        {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                nome,
                tipo,
                preco
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

    } else {

        mensagem.innerHTML =
        `<div class="alert alert-danger">
            ${dados.message}
        </div>`;
    }

});
