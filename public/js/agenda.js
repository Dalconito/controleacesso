document.addEventListener("DOMContentLoaded", function () {
  const agenda = document.getElementById("agenda");

  if (!agenda) {
    return;
  }

  const modal = document.getElementById("modalEvento");

  const fecharModal = document.getElementById("fecharModalEvento");

  const modalNome = document.getElementById("modalEventoNome");
  const modalInicio = document.getElementById("modalEventoInicio");
  const modalFim = document.getElementById("modalEventoFim");
  const modalResponsavel = document.getElementById("modalEventoResponsavel");
  const modalEndereco = document.getElementById("modalEventoEndereco");

  const calendar = new FullCalendar.Calendar(agenda, {
    locale: "pt-br",

    initialView: "dayGridMonth",

    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },

    buttonText: {
      today: "Hoje",
      month: "Mês",
      week: "Semana",
      day: "Dia",
    },

    events: window.eventosAgenda || [],

    eventClick: function (info) {
      const evento = info.event;

      modalNome.textContent = evento.title;

      modalInicio.textContent = formatarData(evento.start);

      modalFim.textContent = formatarData(evento.end);

      modalResponsavel.textContent =
        evento.extendedProps.responsavel || "Não informado";

      modalEndereco.textContent =
        evento.extendedProps.endereco || "Não informado";

      modal.classList.add("ativo");
    },
  });

  calendar.render();

  // Fechar pelo X
  fecharModal.addEventListener("click", function () {
    fecharModalEvento();
  });

  // Fechar clicando fora da janela
  modal.addEventListener("click", function (event) {
    if (event.target === modal) {
      fecharModalEvento();
    }
  });

  // Fechar com ESC
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      fecharModalEvento();
    }
  });

  function fecharModalEvento() {
    modal.classList.remove("ativo");
  }
});

function formatarData(data) {
  if (!data) {
    return "Não informado";
  }

  return new Intl.DateTimeFormat("pt-BR", {
    dateStyle: "short",
    timeStyle: "short",
  }).format(data);
}
