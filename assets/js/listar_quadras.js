async function carregarQuadras() {

    const resposta = await fetch(
        "../api/quadras/listar.php"
    );

    const quadras = await resposta.json();

    const tabela =
    document.getElementById("tabelaQuadras");

    tabela.innerHTML = "";

    quadras.forEach(quadra => {

        tabela.innerHTML += `

        <tr>

            <td>${quadra.id}</td>

            <td>${quadra.nome}</td>

            <td>${quadra.tipo}</td>

            <td>R$ ${quadra.preco_hora}</td>

        </tr>

        `;
    });

}

carregarQuadras();