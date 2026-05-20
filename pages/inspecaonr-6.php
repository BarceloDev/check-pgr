<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./index.css" />
    <title>CheckPGR - Inspeção NR-06</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50 select-none" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-xs border-b border-slate-100 sticky top-0 z-50">
      <div class="w-full max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <a href="./dashboard.php" class="text-slate-400 hover:text-slate-600 transition-colors p-2 -ml-2 shrink-0 active:scale-95">
            <i class="bi bi-arrow-left text-lg"></i>
          </a>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Inspeção NR-06</h1>
            <p class="text-[11px] text-slate-400 truncate">Equipamentos de Proteção Individual</p>
          </div>
        </div>
        
        <span class="bg-emerald-50 text-emerald-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider shrink-0">Setor Ativo</span>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-4 md:py-8">
      <div class="w-full max-w-[1200px] px-4 space-y-4 md:space-y-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-xs">
          <div class="flex justify-between items-center mb-1.5">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Progresso</span>
            <span class="text-[11px] font-bold text-blue-600" id="progress-text">0% Concluído</span>
          </div>
          <div class="w-full bg-slate-100 rounded-full h-2">
            <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
          </div>
        </div>

        <form action="./relatorio.php" method="POST" enctype="multipart/form-data" id="form-inspecao" class="space-y-4 md:space-y-6" novalidate autocomplete="off">
          
          <div class="bg-white border border-slate-100 rounded-2xl p-4 md:p-6 shadow-xs space-y-4 question-block transition-all duration-200" id="block-p1">
            <div class="flex items-start gap-2.5">
              <span class="bg-slate-100 text-slate-700 font-mono text-[11px] w-5 h-5 rounded-md flex items-center justify-center shrink-0 mt-0.5">01</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">
                Os Equipamentos de Proteção Individual (EPI) fornecidos possuem Certificado de Aprovação (CA) válido e são adequados ao risco da atividade?
              </p>
            </div>
            
            <div class="grid grid-cols-2 gap-3 pt-1">
              <label class="flex flex-col sm:flex-row items-center justify-center gap-1.5 border border-slate-200 rounded-xl py-3.5 px-3 text-xs md:text-sm font-semibold text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700 select-none active:scale-[0.98]">
                <input type="radio" name="p1" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle text-sm"></i> Conforme
              </label>
              <label class="flex flex-col sm:flex-row items-center justify-center gap-1.5 border border-slate-200 rounded-xl py-3.5 px-3 text-xs md:text-sm font-semibold text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700 select-none active:scale-[0.98]">
                <input type="radio" name="p1" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle text-sm"></i> Não Conforme
              </label>
            </div>

            <p class="text-[11px] text-rose-500 font-medium hidden error-message flex items-center gap-1 pt-0.5">
              <i class="bi bi-exclamation-circle-fill"></i> Selecione uma opção acima.
            </p>

            <div class="pt-3 border-t border-slate-100 space-y-3">
              <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Observações / Não Conformidades</label>
                <textarea 
                  name="obs_p1"
                  rows="2" 
                  autocorrect="off"
                  autocapitalize="sentences"
                  spellcheck="false"
                  placeholder="Descreva detalhes caso encontre irregularidades..." 
                  class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
                ></textarea>
              </div>

              <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Evidência Fotográfica</label>
                <div class="w-full min-h-[90px] relative">
                  
                  <div class="w-full min-h-[90px] bg-slate-50 border border-dashed border-slate-200 rounded-xl p-4 hover:bg-slate-100/70 transition-all text-center group flex flex-col items-center justify-center upload-wrapper">
                    <input 
                      type="file" 
                      name="foto_p1" 
                      accept="image/*" 
                      capture="environment"
                      class="absolute inset-0 w-full h-full opacity-0 cursor-pointer image-input z-10"
                    />
                    <div class="space-y-0.5">
                      <div class="text-slate-400 group-hover:text-blue-500 transition-colors text-lg">
                        <i class="bi bi-camera"></i>
                      </div>
                      <p class="text-xs font-semibold text-slate-600">Tirar foto ou fazer upload</p>
                      <p class="text-[9px] text-slate-400">PNG, JPG ou JPEG (Máx. 5MB)</p>
                    </div>
                  </div>

                  <div class="w-full flex items-center justify-between gap-2 bg-white border border-slate-200 rounded-xl p-2.5 shadow-xs transition-all preview-wrapper" style="display: none;">
                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                      <img src="" class="w-11 h-11 object-cover rounded-md border border-slate-100 img-preview-element shrink-0" />
                      <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-700 truncate img-name-element">foto.jpg</p>
                        <p class="text-[10px] text-emerald-600 flex items-center gap-0.5"><i class="bi bi-check-circle-fill"></i> Pronta</p>
                      </div>
                    </div>
                    <button type="button" class="w-9 h-9 bg-slate-100 hover:bg-rose-500 text-slate-500 hover:text-white rounded-xl flex items-center justify-center text-sm transition-all cursor-pointer btn-remove-img shrink-0 active:scale-95">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-4 md:p-6 shadow-xs space-y-4 question-block transition-all duration-200" id="block-p2">
            <div class="flex items-start gap-2.5">
              <span class="bg-slate-100 text-slate-700 font-mono text-[11px] w-5 h-5 rounded-md flex items-center justify-center shrink-0 mt-0.5">02</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">
                Há registro formalizado (ficha de EPI ou sistema eletrônico) da entrega e higienização periódica dos EPIs aos respectivos colaboradores?
              </p>
            </div>
            
            <div class="grid grid-cols-2 gap-3 pt-1">
              <label class="flex flex-col sm:flex-row items-center justify-center gap-1.5 border border-slate-200 rounded-xl py-3.5 px-3 text-xs md:text-sm font-semibold text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700 select-none active:scale-[0.98]">
                <input type="radio" name="p2" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle text-sm"></i> Conforme
              </label>
              <label class="flex flex-col sm:flex-row items-center justify-center gap-1.5 border border-slate-200 rounded-xl py-3.5 px-3 text-xs md:text-sm font-semibold text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700 select-none active:scale-[0.98]">
                <input type="radio" name="p2" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle text-sm"></i> Não Conforme
              </label>
            </div>

            <p class="text-[11px] text-rose-500 font-medium hidden error-message flex items-center gap-1 pt-0.5">
              <i class="bi bi-exclamation-circle-fill"></i> Selecione uma opção acima.
            </p>

            <div class="pt-3 border-t border-slate-100 space-y-3">
              <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Observações / Não Conformidades</label>
                <textarea 
                  name="obs_p2"
                  rows="2" 
                  autocorrect="off"
                  autocapitalize="sentences"
                  spellcheck="false"
                  placeholder="Descreva detalhes caso encontre irregularidades..." 
                  class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
                ></textarea>
              </div>

              <div>
                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Evidência Fotográfica</label>
                <div class="w-full min-h-[90px] relative">
                  
                  <div class="w-full min-h-[90px] bg-slate-50 border border-dashed border-slate-200 rounded-xl p-4 hover:bg-slate-100/70 transition-all text-center group flex flex-col items-center justify-center upload-wrapper">
                    <input 
                      type="file" 
                      name="foto_p2" 
                      accept="image/*" 
                      capture="environment"
                      class="absolute inset-0 w-full h-full opacity-0 cursor-pointer image-input z-10"
                    />
                    <div class="space-y-0.5">
                      <div class="text-slate-400 group-hover:text-blue-500 transition-colors text-lg">
                        <i class="bi bi-camera"></i>
                      </div>
                      <p class="text-xs font-semibold text-slate-600">Tirar foto ou fazer upload</p>
                      <p class="text-[9px] text-slate-400">PNG, JPG ou JPEG (Máx. 5MB)</p>
                    </div>
                  </div>

                  <div class="w-full flex items-center justify-between gap-2 bg-white border border-slate-200 rounded-xl p-2.5 shadow-xs transition-all preview-wrapper" style="display: none;">
                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                      <img src="" class="w-11 h-11 object-cover rounded-md border border-slate-100 img-preview-element shrink-0" />
                      <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-700 truncate img-name-element">foto.jpg</p>
                        <p class="text-[10px] text-emerald-600 flex items-center gap-0.5"><i class="bi bi-check-circle-fill"></i> Pronta</p>
                      </div>
                    </div>
                    <button type="button" class="w-9 h-9 bg-slate-100 hover:bg-rose-500 text-slate-500 hover:text-white rounded-xl flex items-center justify-center text-sm transition-all cursor-pointer btn-remove-img shrink-0 active:scale-95">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="flex gap-3 pt-2">
            <a href="./dashboard.php" id="btn-cancelar" class="w-1/3 border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 font-semibold rounded-xl py-3.5 text-xs md:text-sm transition-colors text-center shadow-xs select-none active:bg-slate-100 flex items-center justify-center -webkit-tap-highlight-color-transparent">
              Cancelar
            </a>
            <button type="submit" id="btn-submit" class="w-2/3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3.5 text-xs md:text-sm transition-all shadow-sm shadow-blue-100 cursor-pointer flex items-center justify-center gap-2 select-none active:scale-[0.98]">
              <span id="btn-text">Salvar e Gerar</span>
              <svg id="btn-spinner" class="animate-spin h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </button>
          </div>

        </form>
      </div>
    </div>
    
    <?php include './footer.php'; ?>
    
    <script src="./js/main.js"></script>
  </body>
</html>