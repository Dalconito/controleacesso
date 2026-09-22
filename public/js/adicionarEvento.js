document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formQr");
  const msgUsr = document.getElementById("msgUsr");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    msgUsr.textContent = "";
    msgUsr.className = "";

    const nomeEvento = document.getElementById("nomeEvento").value.trim();
    const responsavel = document.getElementById("Responsavel").value.trim();
    const dataInicio = document.getElementById("dataInicio").value;
    const dataTermino = document.getElementById("dataTermino").value;
    const endereco = document.getElementById("endereco").value.trim();

    // -----------------------------
    // Validações
    // -----------------------------

    if (!nomeEvento) {
      mostrarMensagem("Informe o nome do evento.");
      return;
    }

    if (!responsavel) {
      mostrarMensagem("Informe o responsável.");
      return;
    }

    if (!dataInicio) {
      mostrarMensagem("Informe a data de início.");
      return;
    }

    if (!dataTermino) {
      mostrarMensagem("Informe a data de término.");
      return;
    }

    if (!endereco) {
      mostrarMensagem("Informe o endereço.");
      return;
    }

    // Converte as datas para Date
    const inicio = new Date(dataInicio);
    const termino = new Date(dataTermino);

    if (isNaN(inicio.getTime()) || isNaN(termino.getTime())) {
      mostrarMensagem("Uma das datas informadas é inválida.");
      return;
    }

    // Término não pode ser antes do início
    if (termino <= inicio) {
      mostrarMensagem("A data de término deve ser posterior à data de início.");
      return;
    }

    // -----------------------------
    // Monta os dados
    // -----------------------------

    const dados = {
      nomeEvento: nomeEvento,
      Responsavel: responsavel,
      dataInicio: dataInicio.replace("T", " ") + ":00",
      dataTermino: dataTermino.replace("T", " ") + ":00",
      endereco: endereco,
    };

    console.log("Dados enviados:", dados);

    // -----------------------------
    // Envia para o PHP
    // -----------------------------

    try {
      const response = await fetch("./api/v1/eventos/create", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(dados),
      });

      const resultado = await response.json();

      if (!response.ok) {
        throw new Error(resultado.mensagem || "Erro ao cadastrar evento.");
      }

      mostrarMensagem(
        resultado.mensagem || "Evento cadastrado com sucesso!",
        true,
      );

      form.reset();
    } catch (error) {
      console.error("Erro:", error);

      mostrarMensagem(error.message || "Erro ao comunicar com o servidor.");
    }
  });

  function mostrarMensagem(mensagem, sucesso = false) {
    msgUsr.textContent = mensagem;
    msgUsr.className = sucesso ? "sucesso" : "erro";
  }
});
