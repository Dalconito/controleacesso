document.querySelectorAll("td.status").forEach(function (cell) {
  let status = parseInt(cell.textContent); // Converte o conteúdo para número

  switch (status) {
    case 1:
      cell.style.backgroundColor = "#02a328";
      cell.textContent = "Disponivel";
      break;
    case 2:
      cell.style.backgroundColor = "#07da38";
      break;
    case 1:
      cell.style.backgroundColor = "#ff0303";
      break;
  }
});

document.querySelectorAll(".qrcode").forEach(function (element) {
  const elementos = document.querySelectorAll(".qrcode");

  elementos.forEach(function (element) {
    const codigo = element.dataset.codigo;

    new QRCode(element, {
      text: codigo,
      width: 150,
      height: 150,
    });
  });
});

async function logout() {
  const data = { data: "logout" };
  try {
    const response = await fetch("./controllers/logoutController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/application/json", // Formato tradicional de formulário
      },
      body: JSON.stringify(data), // Não precisa usar JSON.stringify
    });

    if (!response.ok) {
      throw new Error(`Erro: ${response.status}`);
    }

    const respostaJSON = await response.json();
    if (respostaJSON.status == "success") {
      window.location.href = "./index.php";
    }
    console.log("Resposta do servidor:", respostaJSON);
  } catch (error) {
    console.error("Erro ao enviar dados:", error);
  }
}
