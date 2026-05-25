document.addEventListener("DOMContentLoaded", () => {
  function showElement(element) {
    element.classList.remove("hidden");
  }

  function hideElement(element) {
    element.classList.add("hidden");
  }

  // ==========================================
  // 1. CONTROLE DE PROGRESSO
  // ==========================================
  const radios = document.querySelectorAll(".item-check");
  const progressBar = document.getElementById("progress-bar");
  const progressText = document.getElementById("progress-text");
  const questionNames = Array.from(
    new Set(
      Array.from(radios)
        .map((radio) => radio.name)
        .filter(Boolean),
    ),
  );
  const totalQuestions = questionNames.length;

  if (radios.length > 0 && progressBar && progressText && totalQuestions > 0) {
    // Inicializa o progresso com base no que já estiver marcado
    const initChecked = document.querySelectorAll(".item-check:checked").length;
    const initPercentage = Math.round((initChecked / totalQuestions) * 100);
    progressBar.style.width = `${initPercentage}%`;
    progressText.innerText = `${initPercentage}% Concluído`;

    radios.forEach((radio) => {
      radio.addEventListener("change", () => {
        const checkedCount = document.querySelectorAll(
          ".item-check:checked",
        ).length;
        const percentage = Math.round((checkedCount / totalQuestions) * 100);

        progressBar.style.width = `${percentage}%`;
        progressText.innerText = `${percentage}% Concluído`;
      });
    });
  }
  // ==========================================
  // REFINAMENTO DE UX: FOCO AUTOMÁTICO EM NÃO CONFORMIDADES
  // ==========================================
  document.querySelectorAll(".item-check").forEach((radio) => {
    radio.addEventListener("change", function () {
      // Se o usuário marcou "Não Conforme"
      if (this.value === "nao-conforme") {
        // Encontra o bloco da pergunta onde esse rádio está
        const bloco = this.closest(".question-block");
        if (bloco) {
          const textarea = bloco.querySelector("textarea");
          if (textarea) {
            // Dá um pequeno delay para a transição visual do rádio acontecer primeiro
            setTimeout(() => {
              textarea.focus();
            }, 150);
          }
        }
      }
    });
  });

  // ==========================================
  // 3. VALIDAÇÃO INDEPENDENTE E LOADING STATE
  // ==========================================
  const formInspecao = document.getElementById("form-inspecao");
  const btnSubmit = document.getElementById("btn-submit");
  const btnText = document.getElementById("btn-text");
  const btnSpinner = document.getElementById("btn-spinner");
  const btnCancelar = document.getElementById("btn-cancelar");

  if (formInspecao) {
    formInspecao.addEventListener("submit", function (e) {
      if (!confirm("Tem certeza que deseja salvar o relatório?")) {
        e.preventDefault();
        return;
      }

      let formValido = true;
      const inputsValidar = questionNames;

      inputsValidar.forEach((name) => {
        const queryRadios = document.getElementsByName(name);
        const blocoPergunta = document.getElementById(`block-${name}`);

        // Se você não colocou os IDs block-pX no HTML, ele tenta achar por classe de fallback
        const bloco =
          blocoPergunta || queryRadios[0]?.closest(".question-block");
        if (!bloco) return;

        const alertaErro = bloco.querySelector(".error-message");

        // Verifica se o rádio foi respondido
        let respondido = false;
        for (const radio of queryRadios) {
          if (radio.checked) {
            respondido = true;
            break;
          }
        }

        if (!respondido) {
          formValido = false;
          if (alertaErro) showElement(alertaErro);
          bloco.classList.remove("border-slate-100");
          bloco.classList.add("border-rose-300", "ring-1", "ring-rose-100");
        } else {
          if (alertaErro) hideElement(alertaErro);
          bloco.classList.remove("border-rose-300", "ring-1", "ring-rose-100");
          bloco.classList.add("border-slate-100");
        }
      });

      if (!formValido) {
        e.preventDefault();
        const primeiroErro = document.querySelector(
          ".error-message:not(.hidden)",
        );
        const alvoScroll = primeiroErro
          ? primeiroErro.closest(".question-block")
          : document.querySelector(".border-rose-300");

        if (alvoScroll) {
          alvoScroll.scrollIntoView({ behavior: "smooth", block: "center" });
        }
        return;
      }

      // Evita cliques múltiplos criando uma "película" invisível na tela
      const overlay = document.createElement("div");
      overlay.style.position = "fixed";
      overlay.style.top = "0";
      overlay.style.left = "0";
      overlay.style.width = "100vw";
      overlay.style.height = "100vh";
      overlay.style.zIndex = "9999";
      overlay.style.cursor = "not-allowed";
      document.body.appendChild(overlay);

      // --- ATIVA O ESTADO DE LOADING (Se tudo estiver OK) ---
      // Impede envios múltiplos se o usuário clicar duas vezes enquanto sobe fotos pesadas
      if (btnSubmit) {
        btnSubmit.disabled = true;
        btnSubmit.classList.remove("bg-blue-600", "hover:bg-blue-700");
        btnSubmit.classList.add("bg-blue-500", "cursor-not-allowed");
      }

      if (btnCancelar) {
        btnCancelar.style.pointerEvents = "none";
        btnCancelar.classList.add("opacity-50");
      }

      if (btnText) btnText.innerText = "Processando e Enviando...";
      if (btnSpinner) showElement(btnSpinner);
    });

    // Remove a borda vermelha de erro assim que o usuário seleciona uma opção
    document.querySelectorAll(".item-check").forEach((radio) => {
      radio.addEventListener("change", function () {
        const name = this.getAttribute("name");
        const blocoPergunta =
          document.getElementById(`block-${name}`) ||
          this.closest(".question-block");
        if (!blocoPergunta) return;

        const alertaErro = blocoPergunta.querySelector(".error-message");

        if (alertaErro) hideElement(alertaErro);
        blocoPergunta.classList.remove(
          "border-rose-300",
          "ring-1",
          "ring-rose-100",
        );
        blocoPergunta.classList.add("border-slate-100");
      });
    });
  }
});
