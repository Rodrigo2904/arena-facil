async function verificarAcesso() {

    const resposta = await fetch(

        "/arena-facil/api/usuarios/verificar_sessao.php"

    );

    const dados = await resposta.json();

    if (!dados.logado) {

        window.location.href =

        "/arena-facil/frontend/login.html";

        return;

    }

    if (dados.tipo !== "proprietario") {

        alert(

            "Acesso permitido somente para proprietários."

        );

        window.location.href =

        "/arena-facil/frontend/dashboard_cliente.html";

    }

}

verificarAcesso();