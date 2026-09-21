function mostrarQrCode(id) {
  const linha = document.getElementById(`qrcode-${id}`);

  if (!linha) {
    return;
  }

  linha.classList.add("visivel");

  const container = linha.querySelector(".qrcode");

  // Evita gerar novamente
  if (container.dataset.gerado === "true") {
    return;
  }

  const codigo = container.dataset.codigo;

  new QRCode(container, {
    text: codigo,
    width: 220,
    height: 220,
  });

  container.dataset.gerado = "true";
}

function fecharQrCode(id) {
  const linha = document.getElementById(`qrcode-${id}`);

  if (!linha) {
    return;
  }

  linha.classList.remove("visivel");
}

async function abrirSeeder(idEvento) {
  const quantidade = prompt("Quantos ingressos deseja criar?");

  if (quantidade === null) {
    return;
  }

  const quantidadeNumero = parseInt(quantidade, 10);

  if (!Number.isInteger(quantidadeNumero) || quantidadeNumero <= 0) {
    alert("Informe uma quantidade válida.");
    return;
  }

  const response = await fetch("/api/v1/ingressos/seeder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      quantidade: quantidadeNumero,
      idEvento: idEvento,
    }),
  });

  const texto = await response.text();

  console.log("Resposta PHP:", texto);

  if (!texto) {
    throw new Error("O servidor retornou uma resposta vazia.");
  }

  const resultado = JSON.parse(texto);

  if (!resultado.sucesso) {
    alert(resultado.erro);
    return;
  }

  alert(resultado.mensagem);

  location.reload();
}
