document.addEventListener('DOMContentLoaded', () => {
  
  // ==========================================
  // 1. CONTROLE DE PROGRESSO
  // ==========================================
  const radios = document.querySelectorAll('.item-check');
  const progressBar = document.getElementById('progress-bar');
  const progressText = document.getElementById('progress-text');
  const totalQuestions = 2;

  if (radios.length > 0 && progressBar && progressText) {
    radios.forEach(radio => {
      radio.addEventListener('change', () => {
        const checkedCount = document.querySelectorAll('.item-check:checked').length;
        const percentage = Math.round((checkedCount / totalQuestions) * 100);
        
        progressBar.style.width = `${percentage}%`;
        progressText.innerText = `${percentage}% Concluído`;
      });
    });
  }
  // ==========================================
  // REFINAMENTO DE UX: FOCO AUTOMÁTICO EM NÃO CONFORMIDADES
  // ==========================================
  document.querySelectorAll('.item-check').forEach(radio => {
    radio.addEventListener('change', function() {
      // Se o usuário marcou "Não Conforme"
      if (this.value === 'nao-conforme') {
        // Encontra o bloco da pergunta onde esse rádio está
        const bloco = this.closest('.question-block');
        if (bloco) {
          const textarea = bloco.querySelector('textarea');
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
  // 2. CONTROLE DE PREVIEW E EXCLUSÃO (SELEÇÃO DIRETA)
  // ==========================================
  const imageInputs = document.querySelectorAll('.image-input');

  const hideElement = element => {
    if (!element) return;
    element.style.display = 'none';
    element.classList.add('hidden');
  };

  const showElement = element => {
    if (!element) return;
    element.style.display = '';
    element.classList.remove('hidden');
  };

  imageInputs.forEach(input => {
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      const uploadWrapper = this.closest('.upload-wrapper') || this.parentElement;
      const containerBox = uploadWrapper.closest('.relative') || uploadWrapper.parentElement;
      const previewWrapper = containerBox.querySelector('.preview-wrapper, .group-upload-preview');
      const placeholderWrapper = containerBox.querySelector('.upload-wrapper, .group-upload-placeholder');
      const previewImg = containerBox.querySelector('.img-preview-element');
      const previewName = containerBox.querySelector('.img-name-element');

      if (!file || !previewWrapper || !previewImg || !previewName) {
        return;
      }

      previewName.innerText = file.name;

      const reader = new FileReader();
      reader.onload = function(event) {
        previewImg.src = event.target.result;
        hideElement(placeholderWrapper);
        showElement(previewWrapper);
        input.style.pointerEvents = 'none';
      };
      reader.readAsDataURL(file);
    });
  });

  // Evento disparado ao clicar na lixeira
  const removeButtons = document.querySelectorAll('.btn-remove-img');

  removeButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();

      const previewWrapper = this.closest('.preview-wrapper, .group-upload-preview');
      const containerBox = previewWrapper ? previewWrapper.parentElement : this.parentElement.parentElement;
      const uploadWrapper = containerBox.querySelector('.upload-wrapper, .group-upload-placeholder');
      const fileInput = containerBox.querySelector('.image-input');
      const previewImg = containerBox.querySelector('.img-preview-element');
      const previewName = containerBox.querySelector('.img-name-element');

      if (fileInput) {
        fileInput.value = '';
        fileInput.style.pointerEvents = 'auto';
      }

      if (previewImg) {
        previewImg.src = '';
      }

      if (previewName) {
        previewName.innerText = '';
      }

      showElement(uploadWrapper);
      hideElement(previewWrapper);
    });
  });

  // ==========================================
  // 3. VALIDAÇÃO INDEPENDENTE E LOADING STATE
  // ==========================================
  const formInspecao = document.getElementById('form-inspecao');
  const btnSubmit = document.getElementById('btn-submit');
  const btnText = document.getElementById('btn-text');
  const btnSpinner = document.getElementById('btn-spinner');
  const btnCancelar = document.getElementById('btn-cancelar');

  if (formInspecao) {
    formInspecao.addEventListener('submit', function(e) {
      let formValido = true;
      const inputsValidar = ['p1', 'p2']; // Mapeia os names dos rádios

      inputsValidar.forEach(name => {
        const queryRadios = document.getElementsByName(name);
        const blocoPergunta = document.getElementById(`block-${name}`);
        
        // Se você não colocou os IDs block-p1 e block-p2 no HTML, ele tenta achar por classe de fallback
        const bloco = blocoPergunta || queryRadios[0]?.closest('.question-block');
        if (!bloco) return;

        const alertaErro = bloco.querySelector('.error-message');

        // Verifica se o rádio foi respondido
        let respondido = false;
        for (const radio of queryRadios) {
          if (radio.checked) {
            respondido = true;
            break;
          }
        }
        // Dentro do if (formValido) no main.js
        if (formValido) {
          // Evita cliques múltiplos criando uma "película" invisível na tela
          const overlay = document.createElement('div');
          overlay.style.position = 'fixed';
          overlay.style.top = '0';
          overlay.style.left = '0';
          overlay.style.width = '100vw';
          overlay.style.height = '100vh';
          overlay.style.zIndex = '9999';
          overlay.style.cursor = 'not-allowed';
          document.body.appendChild(overlay);
          // Ativa o loading que você já tem...
        }

        if (!respondido) {
          formValido = false;
          // Exibe o texto do erro (se existir no seu HTML)
          if (alertaErro) showElement(alertaErro);
          
          // Feedback visual na borda usando os tokens do Tailwind v4
          bloco.classList.remove('border-slate-100');
          bloco.classList.add('border-rose-300', 'ring-1', 'ring-rose-100');
        } else {
          if (alertaErro) hideElement(alertaErro);
          bloco.classList.remove('border-rose-300', 'ring-1', 'ring-rose-100');
          bloco.classList.add('border-slate-100');
        }
      });

      // Se travar a validação, cancela o envio e rola até o primeiro erro
      if (!formValido) {
        e.preventDefault();
        const primeiroErro = document.querySelector('.error-message:not(.hidden)');
        const alvoScroll = primeiroErro ? primeiroErro.closest('.question-block') : document.querySelector('.border-rose-300');
        
        if (alvoScroll) {
          alvoScroll.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
      }

      // --- ATIVA O ESTADO DE LOADING (Se tudo estiver OK) ---
      // Impede envios múltiplos se o usuário clicar duas vezes enquanto sobe fotos pesadas
      if (btnSubmit) {
        btnSubmit.disabled = true;
        btnSubmit.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        btnSubmit.classList.add('bg-blue-500', 'cursor-not-allowed');
      }
      
      if (btnCancelar) {
        btnCancelar.style.pointerEvents = 'none';
        btnCancelar.classList.add('opacity-50');
      }

      if (btnText) btnText.innerText = "Processando e Enviando...";
      if (btnSpinner) showElement(btnSpinner);
    });

    // Remove a borda vermelha de erro assim que o usuário seleciona uma opção
    document.querySelectorAll('.item-check').forEach(radio => {
      radio.addEventListener('change', function() {
        const name = this.getAttribute('name');
        const blocoPergunta = document.getElementById(`block-${name}`) || this.closest('.question-block');
        if (!blocoPergunta) return;

        const alertaErro = blocoPergunta.querySelector('.error-message');

        if (alertaErro) hideElement(alertaErro);
        blocoPergunta.classList.remove('border-rose-300', 'ring-1', 'ring-rose-100');
        blocoPergunta.classList.add('border-slate-100');
      });
    });
  }

});