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
    <title>CheckPGR - Dashboard</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-md border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
            SP
          </div>
          <div>
            <h1 class="text-lg font-bold text-slate-800">Olá, Sérgio Paula</h1>
            <p class="text-xs text-slate-400">Pronto para iniciar a validação</p>
          </div>
        </div>
        
        <a href="./index.php" class="text-slate-400 hover:text-red-500 transition-colors">
          <i class="bi bi-box-arrow-right text-xl"></i>
        </a>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-8">
      <div class="w-full max-w-[1000px] px-6 space-y-6">
        
        <main class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4 shadow-sm">
          <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Selecione o Setor para Inspeção</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <a href="./inspecaonr-10.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-5 hover:border-amber-500 transition-all flex flex-col justify-between min-h-[150px]">
              <div class="flex items-start justify-between">
                <span class="bg-amber-50 text-amber-600 font-bold px-3 py-1 rounded-lg text-xs">NR-10</span>
                <div class="w-9 h-9 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-lightning-charge"></i>
                </div>
              </div>
              <p class="text-xs font-medium text-slate-600 mt-4 leading-relaxed">
                NR-10 Serviços em Instalações Elétricas Energizadas
              </p>
            </a>

            <a href="./inspecaonr-6.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-5 hover:border-teal-500 transition-all flex flex-col justify-between min-h-[150px]">
              <div class="flex items-start justify-between">
                <span class="bg-teal-50 text-teal-600 font-bold px-3 py-1 rounded-lg text-xs">NR-6</span>
                <div class="w-9 h-9 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-shield-shaded"></i>
                </div>
              </div>
              <p class="text-xs font-medium text-slate-600 mt-4 leading-relaxed">
                NR-6 EPI (Equipamento de Proteção Individual)
              </p>
            </a>

            <a href="./inspecaonr-23.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-5 hover:border-rose-500 transition-all flex flex-col justify-between min-h-[150px]">
              <div class="flex items-start justify-between">
                <span class="bg-rose-50 text-rose-600 font-bold px-3 py-1 rounded-lg text-xs">NR-23</span>
                <div class="w-9 h-9 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-fire"></i>
                </div>
              </div>
              <p class="text-xs font-medium text-slate-600 mt-4 leading-relaxed">
                NR-23 Proteção Contra Incêndios
              </p>
            </a>
            
          </div>
        </main>

        <section class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4 shadow-sm">
          <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-500">Relatórios Recentes</h2>
          <div class="bg-slate-50 border border-slate-100 rounded-xl p-8 text-center flex flex-col items-center justify-center min-h-[200px]">
            <div class="w-12 h-12 bg-white text-slate-300 rounded-full flex items-center justify-center mb-3 text-lg shadow-xs">
              <i class="bi bi-clipboard-x"></i>
            </div>
            <p class="text-sm text-slate-400 font-medium">Nenhum Relatório Gerado Hoje</p>
          </div>
        </section>

      </div>
    </div>
    
    <?php include './footer.php'; ?>

    <script src="./js/main.js"></script>
  </body>
</html>