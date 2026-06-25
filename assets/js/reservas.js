async function carregarQuadras() {

    const resposta = await fetch(
        "../api/quadras/listar.php"
    );

    const quadras = await resposta.json();

    const select =
    document.getElementById("quadra_id");

    quadras.forEach(quadra => {

        select.innerHTML += `

        <option value="${quadra.id}">

            ${quadra.nome} - ${quadra.tipo}

        </option>

        `;
    });

}

carregarQuadras();

document
.getElementById("reservaForm")
.addEventListener("submit", async function(e) {

    e.preventDefault();

    const confirmar = confirm(
        "Deseja confirmar esta reserva?"
    );

    if (!confirmar) {
        return;
    }

    const quadra_id =
    document.getElementById("quadra_id").value;

    const data_reserva =
    document.getElementById("data_reserva").value;

    const horario =
    document.getElementById("horario").value;

    const resposta = await fetch(
        "../api/reservas/salvar.php",
        {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                quadra_id,
                data_reserva,
                horario
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