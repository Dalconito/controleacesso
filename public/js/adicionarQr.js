const data = new URLSearchParams();
data.append("nome", "John Doe");
data.append("email", "johndoe@example.com");

async function logout() {
  try {
    const response = await fetch("./api/v1/auth/logout.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded", // Formato tradicional de formulário
      },
      body: data,
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

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formQr");
  const cpf = document.getElementById("cpf");
  const msgUsr = document.getElementById("msgUsr");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    if (cpf.value.trim().length !== 14) {
      msgUsr.style.display = "block";
      msgUsr.textContent = "Por favor, insira um CPF válido.";
      return;
    }

    const formData = new FormData(form);

    try {
      const response = await fetch("./api/v1/ingressos/create", {
        method: "POST",
        body: formData,
      });

      const responseData = await response.json();

      if (!response.ok) {
        msgUsr.style.display = "block";
        msgUsr.textContent = responseData.message;
        return;
      }

      msgUsr.style.display = "block";
      msgUsr.textContent = responseData.message;

      console.log("Sucesso:", responseData);
    } catch (error) {
      console.error("Erro:", error);

      msgUsr.style.display = "block";
      msgUsr.textContent = "Erro ao comunicar com o servidor.";
    }
  });
});
