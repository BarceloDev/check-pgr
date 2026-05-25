<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="./index.css" />
    <title>CheckPGR - Inspeção NR-10</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-md border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <a href="./dashboard.php" class="text-slate-400 hover:text-slate-600 transition-colors mr-1">
            <i class="bi bi-arrow-left text-xl"></i>
          </a>
          <div>
            <h1 class="text-base font-bold text-slate-800">Formulário de Inspeção NR-10</h1>
            <p class="text-xs text-slate-400">Inspeção de Serviços em instalações elétricas energizadas</p>
          </div>
        </div>
        
        <span class="bg-amber-50 text-amber-600 font-bold px-3 py-1 rounded-lg text-xs">Setor Ativo</span>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-8">
      <div class="w-full max-w-[1200px] px-6 space-y-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
          <div class="flex justify-between items-center mb-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Progresso da Inspeção</span>
            <span class="text-xs font-bold text-blue-600" id="progress-text">0% Concluído</span>
          </div>
          <div class="w-full bg-slate-100 rounded-full h-2">
            <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
          </div>
        </div>

        <form action="../backend/save_checklist.php" method="POST" id="form-inspecao" class="space-y-6">
          <input type="hidden" name="setor" value="nr_10" />
          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p1">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">01</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">O Prontuário das Instalações Elétricas (PIE) está atualizado e disponível?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p1" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p1" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p1" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p2">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">02</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">Diagramas unifilares das instalações elétricas correspondem à realidade atual?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p2" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p2" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p2" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p3">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">03</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">O Laudo de SPDA (Para-raios) e aterramento está vigente e assinado por Eng. Eletricista?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p3" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p3" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p3" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p4">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">04</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">Os painéis estão íntegros, fechados e sem partes vivas (cabos/barramentos) expostas?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p4" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p4" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p4" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p5">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">05</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">O procedimento LOTO (Lockout/Tagout) possui cadeados individuais para cada eletricista?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p5" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p5" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p5" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p6">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">06</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">A equipe possui e utiliza detectores de tensão testados antes e após cada verificação?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p6" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p6" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p6" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p7">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">07</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">Eletricistas utilizam vestimentas antichama (nível de ATPV adequado ao painel)?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p7" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p7" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p7" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p8">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">08</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">Luvas isolantes de borracha possuem evidência de teste elétrico periódico em dia?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p8" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p8" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p8" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p9">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">09</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">100% dos trabalhadores autorizados possuem o treinamento NR-10 Básico (40h) e a reciclagem bienal dentro do prazo de 2 anos?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p9" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p9" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p9" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>

          <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4 question-block" id="block-p10">
            <div class="flex items-start gap-3">
              <span class="bg-slate-100 text-slate-700 font-mono text-xs w-6 h-6 rounded-md flex items-center justify-center shrink-0 mt-0.5">10</span>
              <p class="text-sm font-medium text-slate-700 leading-relaxed">Os Atestados de Saúde Ocupacional (ASO) estão válidos e atestam aptidão para risco elétrico?</p>
            </div>
            <div class="grid grid-cols-2 gap-3 pt-2">
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/50 has-[:checked]:text-emerald-700">
                <input type="radio" name="p10" value="conforme" class="hidden item-check" />
                <i class="bi bi-check-circle"></i> Conforme
              </label>
              <label class="flex items-center justify-center gap-2 border border-slate-200 rounded-xl py-3 px-4 text-sm font-medium text-slate-600 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:text-rose-700">
                <input type="radio" name="p10" value="nao-conforme" class="hidden item-check" />
                <i class="bi bi-x-circle"></i> Não Conforme
              </label>
            </div>
            <div class="pt-4 border-t border-slate-100 space-y-4">
              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Observações / Não Conformidades</label>
                <textarea name="obs_p10" rows="2" placeholder="Descreva detalhes caso encontre irregularidades..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
              </div>
            </div>
          </div>
          <div class="flex gap-4 pt-2">
            <a href="./dashboard.php" id="btn-cancelar" class="w-1/3 border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 font-medium rounded-xl py-3 text-sm transition-colors text-center shadow-xs">Cancelar</a>
            <button type="submit" id="btn-submit" class="w-2/3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl py-3 text-sm transition-colors shadow-sm shadow-blue-100 cursor-pointer flex items-center justify-center gap-2">
              <span id="btn-text">Salvar e Gerar Relatório</span>
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
    <script src="../js/main.js"></script>
  </body>
</html>
