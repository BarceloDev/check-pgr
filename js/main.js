document.addEventListener('DOMContentLoaded', () => {
  
  // ==========================================
  // 1. CONTROLE DE PROGRESSO (PÁGINA DE INSPEÇÃO)
  // ==========================================
  const radios = document.querySelectorAll('.item-check');
  const progressBar = document.getElementById('progress-bar');
  const progressText = document.getElementById('progress-text');
  
  const totalQuestions = 2; // Ajustado para o modelo atual de 2 blocos de exemplo

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
  // 2. CONTROLE DE PREVIEW DE IMAGENS/FOTOS
  // ==========================================
  const imageInputs = document.querySelectorAll('.image-input');

  imageInputs.forEach(input => {
    // Escuta quando um arquivo de foto for selecionado ou batido pela câmera
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      const container = this.parentElement;
      const placeholder = container.querySelector('.group-upload-placeholder');
      const previewContainer = container.querySelector('.group-upload-preview');
      const previewImg = container.querySelector('.img-preview-element');
      const previewName = container.querySelector('.img-name-element');

      if (file) {
        // Altera o nome legível do arquivo no card
        previewName.innerText = file.name;

        // Gera a URL da miniatura temporária
        const reader = new FileReader();
        reader.onload = function(event) {
          previewImg.src = event.target.result;
          
          // Troca as telas: esconde o convite de clique e mostra a miniatura
          placeholder.classList.add('hidden');
          previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
      }
    });

    // Configura a lógica do botão de lixeira (remover a foto do input)
    const container = input.parentElement;
    const removeBtn = container.querySelector('.btn-remove-img');
    
    if (removeBtn) {
      removeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation(); // Evita reabrir a janela de escolha de arquivos

        const parentContainer = removeBtn.closest('.relative');
        const fileInput = parentContainer.querySelector('.image-input');
        const placeholder = parentContainer.querySelector('.group-upload-placeholder');
        const previewContainer = parentContainer.querySelector('.group-upload-preview');

        // Limpa o valor binário dentro do input HTML
        fileInput.value = "";
        
        // Desfaz a troca visual voltando para o estado inicial vazado
        previewContainer.classList.add('hidden');
        placeholder.classList.remove('hidden');
      });
    }
  });

});