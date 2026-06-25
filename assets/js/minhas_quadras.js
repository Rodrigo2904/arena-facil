async function carregarQuadras() {

    const resposta = await fetch(

        "/arena-facil/api/quadras/listar_minhas.php"

    );

    const quadras = await resposta.json();

    const tabela =

    document.getElementById(

        "tabelaQuadras"

    );

    tabela.innerHTML = "";

    quadras.forEach(quadra => {

        tabela.innerHTML += `

        <tr>

            <td>${quadra.id}</td>

            <td>${quadra.nome}</td>

            <td>${quadra.tipo}</td>

            <td>R$ ${quadra.preco_hora}</td>

            <td>

                <button

                class="btn btn-danger btn-sm"

                onclick="excluirQuadra(${quadra.id})">

                Excluir

                </button>

            </td>

        </tr>

        `;

    });

}

async function excluirQuadra(id) {

    const confirmar = confirm(
        "Deseja excluir esta quadra?"
    );

    if (!confirmar) {
        return;
    }

    const resposta = await fetch(
        "/arena-facil/api/quadras/excluir.php",
        {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                id
            })
        }
    );

    const dados = await resposta.json();

    alert(dados.message);

    carregarQuadras();

}

carregarQuadras();
