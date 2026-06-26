document
.getElementById("quadraForm")

.addEventListener("submit",

async function(e){

e.preventDefault();

const nome =
document.getElementById("nome").value;

const tipo =
document.getElementById("tipo").value;

const precoRaw =
document.getElementById("preco").value;

// Normaliza valor do input (evita "-"/vírgula indo como string estranha)
const preco = Number(String(precoRaw).replace(',', '.'));


const resposta = await fetch(

"/arena-facil/api/quadras/salvar.php",

{

method:"POST",

headers:{

"Content-Type":"application/json"

},

body:JSON.stringify({

nome,
tipo,
preco

})

}

);

const dados =
await resposta.json();

const mensagem =
document.getElementById("mensagem");

if(dados.status==="success"){

mensagem.innerHTML=

`<div class="alert alert-success">

${dados.message}

</div>`;

document
.getElementById("quadraForm")
.reset();

}else{

mensagem.innerHTML=

`<div class="alert alert-danger">

${dados.message}

</div>`;

}

});