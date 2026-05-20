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
    <title>CheckPGR - Comprovante de Relatório</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50 select-none" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-xs border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <a href="./dashboard.php" class="text-slate-400 hover:text-slate-600 transition-colors p-2 -ml-2 shrink-0 active:scale-95">
            <i class="bi bi-arrow-left text-lg"></i>
          </a>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Comprovante de Inspeção</h1>
            <p class="text-[11px] text-slate-400 truncate">Relatório Técnico Gerado</p>
          </div>
        </div>
        
        <span class="bg-emerald-50 text-emerald-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider flex items-center gap-1.5 shrink-0">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 anonymity animate-pulse"></span> Finalizado
        </span>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-4 md:py-8">
      <div class="w-full max-w-[1000px] px-4 space-y-4 md:space-y-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-4 md:p-6 shadow-xs no-print flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-3 text-center sm:text-left flex-col sm:flex-row min-w-0">
            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-lg shrink-0">
              <i class="bi bi-check-lg"></i>
            </div>
            <div class="min-w-0">
              <h2 class="text-sm font-bold text-slate-800">Inspeção salva com sucesso!</h2>
              <p class="text-xs text-slate-400">O documento abaixo serve como comprovante legal interno.</p>
            </div>
          </div>
          
          <button onclick="window.print()" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 px-5 text-sm transition-all flex items-center justify-center gap-2 cursor-pointer shadow-sm shadow-blue-100 active:scale-[0.98]">
            <i class="bi bi-printer text-base"></i> Imprimir / PDF
          </button>
        </div>

        <main class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-8 shadow-xs space-y-6 md:space-y-8 print-card">
          
          <div class="flex justify-between items-start border-b border-slate-100 pb-5 flex-col sm:flex-row gap-4">
            <div>
              <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm mb-2">
                SP
              </div>
              <h3 class="text-base font-bold text-slate-800">CheckPGR - Sistema de Gestão</h3>
              <p class="text-xs text-slate-400">Laudo Técnico Informativo de Segurança</p>
            </div>
            <div class="text-left sm:text-right text-xs text-slate-500 space-y-1 sm:mt-0 w-full sm:w-auto">
              <p><strong>Cód. Relatório:</strong> #<?php echo rand(1000, 9999); ?></p>
              <p><strong>Data:</strong> <?php echo date('d/m/Y - H:i'); ?></p>
              <p><strong>Status:</strong> Em conformidade parcial</p>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Metadados da Inspeção</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-slate-50 rounded-xl p-4 text-xs sm:text-sm text-slate-600">
              <div class="space-y-1.5">
                <p class="truncate"><strong>Inspetor Responsável:</strong> Sérgio Paula</p>
                <p class="truncate"><strong>E-mail:</strong> inspetor@empresa.com</p>
              </div>
              <div class="space-y-1.5">
                <p class="truncate"><strong>Setor Avaliado:</strong> NR-XX ..........</p>
                <p class="truncate"><strong>Validação:</strong> Auditoria Preventiva Interna</p>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Score de Conformidade</h4>
            <div class="grid grid-cols-3 gap-2 sm:grid-cols-3">
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-emerald-50/30 text-center">
                <p class="text-xl sm:text-2xl font-bold text-emerald-600">85%</p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Geral</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-slate-50 text-center">
                <p class="text-xl sm:text-2xl font-bold text-slate-700">12</p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Itens OK</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-rose-50/30 text-center">
                <p class="text-xl sm:text-2xl font-bold text-rose-600">2</p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Irregularidades</p>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Apontamentos de Irregularidades</h4>
            <div class="border border-slate-100 rounded-xl divide-y divide-slate-100 bg-white">
              
              <div class="p-4 space-y-1.5">
                <div class="flex justify-between items-start gap-4 flex-wrap sm:flex-nowrap">
                  <p class="text-xs font-bold text-slate-700">Item XX: ...................</p>
                  <span class="bg-rose-50 text-rose-600 font-bold px-2 py-0.5 rounded text-[9px] uppercase tracking-wider shrink-0">Não Conforme</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                  <strong>Observação registrada:</strong> ..................................................
                </p>
              </div>

            </div>
          </div>

          <div class="pt-10 sm:pt-14 flex flex-col items-center justify-center text-center space-y-2">
            <div class="w-56 sm:w-64 border-b border-slate-300 h-6"></div>
            <p class="text-xs font-semibold text-slate-700">Assinatura do Inspetor Técnico</p>
            <p class="text-[9px] text-slate-400 max-w-xs sm:max-w-none">Documento eletrônico autenticado via sistema de rastreabilidade CheckPGR</p>
          </div>

        </main>

        <div class="flex justify-center no-print">
          <a href="./dashboard.php" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 hover:text-blue-600 transition-colors py-2 px-3 -webkit-tap-highlight-color-transparent">
            <i class="bi bi-house"></i> Voltar ao Painel Principal
          </a>
        </div>

      </div>
    </div>

    <?php include './footer.php'; ?>
    
    <script src="./js/main.js"></script>
  </body>
</html>