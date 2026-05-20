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
    <title>CheckPGR - Comprovante de Relatório</title>
    <style>
      /* Estilo extra para esconder elementos na impressão do PDF */
      @media print {
        header, .no-print, footer {
          display: none !important;
        }
        body {
          background-image: none !important;
          background-color: #ffffff !important;
        }
        .print-card {
          border: none !important;
          box-shadow: none !important;
          padding: 0 !important;
        }
      }
    </style>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-md border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <a href="./dashboard.php" class="text-slate-400 hover:text-slate-600 transition-colors mr-1">
            <i class="bi bi-arrow-left text-xl"></i>
          </a>
          <div>
            <h1 class="text-base font-bold text-slate-800">Comprovante de Inspeção</h1>
            <p class="text-xs text-slate-400">Relatório Técnico Gerado</p>
          </div>
        </div>
        
        <span class="bg-emerald-50 text-emerald-600 font-bold px-3 py-1 rounded-lg text-xs flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Finalizado
        </span>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-8">
      <div class="w-full max-w-[1000px] px-6 space-y-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm no-print flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-4 text-center sm:text-left flex-col sm:flex-row">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xl shrink-0">
              <i class="bi bi-check-lg"></i>
            </div>
            <div>
              <h2 class="text-sm font-bold text-slate-800">Inspeção salva com sucesso!</h2>
              <p class="text-xs text-slate-400">O documento abaixo serve como comprovante legal interno.</p>
            </div>
          </div>
          
          <button onclick="window.print()" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl py-2.5 px-5 text-sm transition-colors flex items-center justify-center gap-2 cursor-pointer shadow-sm shadow-blue-100">
            <i class="bi bi-printer"></i> Imprimir / PDF
          </button>
        </div>

        <main class="bg-white border border-slate-100 rounded-2xl p-8 shadow-sm space-y-8 print-card">
          
          <div class="flex justify-between items-start border-b border-slate-100 pb-6 flex-col sm:flex-row gap-4">
            <div>
              <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-base mb-2">
                SP
              </div>
              <h3 class="text-base font-bold text-slate-800">CheckPGR - Sistema de Gestão</h3>
              <p class="text-xs text-slate-400">Laudo Técnico Informativo de Segurança</p>
            </div>
            <div class="text-left sm:text-right text-xs text-slate-500 space-y-1">
              <p><strong>Cód. Relatório:</strong> #<?php echo rand(1000, 9999); ?></p>
              <p><strong>Data:</strong> <?php echo date('d/m/Y - H:i'); ?></p>
              <p><strong>Status:</strong> Em conformidade parcial</p>
            </div>
          </div>

          <div class="space-y-3">
            <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Metadados da Inspeção</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-50 rounded-xl p-4 text-sm text-slate-600">
              <div class="space-y-1.5">
                <p><strong>Inspetor Responsável:</strong> Sérgio Paula</p>
                <p><strong>E-mail:</strong> inspetor@empresa.com</p>
              </div>
              <div class="space-y-1.5">
                <p><strong>Setor Avaliado:</strong> NR-XX ..........</p>
                <p><strong>Validação:</strong> Auditoria Preventiva Interna</p>
              </div>
            </div>
          </div>

          <div class="space-y-3">
            <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Score de Conformidade</h4>
            <div class="grid grid-cols-3 gap-4 text-center">
              <div class="border border-slate-100 rounded-xl p-4 bg-emerald-50/30">
                <p class="text-2xl font-bold text-emerald-600">85%</p>
                <p class="text-[10px] uppercase font-semibold text-slate-400 mt-1">Geral</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-4 bg-slate-50">
                <p class="text-2xl font-bold text-slate-700">12</p>
                <p class="text-[10px] uppercase font-semibold text-slate-400 mt-1">Itens OK</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-4 bg-rose-50/30">
                <p class="text-2xl font-bold text-rose-600">2</p>
                <p class="text-[10px] uppercase font-semibold text-slate-400 mt-1">Irregularidades</p>
              </div>
            </div>
          </div>

          <div class="space-y-3">
            <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Apontamentos de Irregularidades</h4>
            <div class="border border-slate-100 rounded-xl divide-y divide-slate-100">
              
              <div class="p-4 space-y-2">
                <div class="flex justify-between items-start gap-4">
                  <p class="text-xs font-bold text-slate-700">Item XX: ...................</p>
                  <span class="bg-rose-50 text-rose-600 font-bold px-2 py-0.5 rounded text-[10px] uppercase shrink-0">Não Conforme</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                  <strong>Observação registrada:</strong> ..................................................
                </p>
              </div>

            </div>
          </div>

          <div class="pt-12 flex flex-col items-center justify-center text-center space-y-2">
            <div class="w-64 border-b border-slate-300 h-8"></div>
            <p class="text-xs font-medium text-slate-700">Assinatura do Inspetor Técnico</p>
            <p class="text-[10px] text-slate-400">Documento eletrônico autenticado via sistema de rastreabilidade CheckPGR</p>
          </div>

        </main>

        <div class="flex justify-center no-print">
          <a href="./dashboard.php" class="text-xs font-medium text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
            <i class="bi bi-house"></i> Voltar ao Painel Principal
          </a>
        </div>

      </div>
    </div>

    <?php include './footer.php'; ?>
    
    <script src="./js/main.js"></script>
  </body>
</html>