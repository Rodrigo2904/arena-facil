async function carregarReservas() {

    const resposta = await fetch(
      "/arena-facil/api/reservas/listar.php"
    );

    const reservas = await resposta.json();

    const tabela =
    document.getElementById("tabelaReservas");

    tabela.innerHTML = "";

    reservas.forEach(reserva => {

        tabela.innerHTML += `

        <tr>

            <td>${reserva.id}</td>

            <td>${reserva.quadra_nome}</td>

            <td>${reserva.data_reserva}</td>

            <td>${reserva.horario}</td>

            <td>${reserva.status}</td>

            <td>

                <button
                class="btn btn-danger btn-sm"

                onclick="cancelarReserva(${reserva.id})">

                    Cancelar

                </button>

            </td>

        </tr>

        `;
    });

}

async function cancelarReserva(id) {

    const confirmar = confirm(
        "Deseja cancelar esta reserva?"
    );

    if (!confirmar) {
        return;
    }

    const resposta = await fetch(
        "/arena-facil/api/reservas/cancelar.php",
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

    carregarReservas();

}

carregarReservas();