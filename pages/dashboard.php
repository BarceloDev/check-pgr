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
    <title>CheckPGR - Dashboard</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-xs border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shrink-0">
            SP
          </div>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Olá, Sérgio Paula</h1>
            <p class="text-[11px] text-slate-400 truncate">Pronto para iniciar a validação</p>
          </div>
        </div>
        
        <a href="./index.php" class="text-slate-400 hover:text-rose-500 transition-colors p-2 shrink-0 active:scale-95">
          <i class="bi bi-box-arrow-right text-lg"></i>
        </a>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-4 md:py-8">
      <div class="w-full max-w-[1000px] px-4 space-y-4 md:space-y-6">
        
        <main class="bg-white border border-slate-100 rounded-2xl p-4 md:p-6 space-y-3.5 shadow-xs">
          <h2 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Selecione o Setor para Inspeção</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:grid-cols-3">
            
            <a href="./inspecaonr-10.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-4 hover:border-amber-500 transition-all flex flex-col justify-between min-h-[130px] md:min-h-[150px] select-none active:scale-[0.98]">
              <div class="flex items-start justify-between">
                <span class="bg-amber-50 text-amber-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider">NR-10</span>
                <div class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-lightning-charge text-sm"></i>
                </div>
              </div>
              <p class="text-xs font-semibold text-slate-600 mt-4 leading-relaxed">
                Serviços em Instalações Elétricas Energizadas
              </p>
            </a>

            <a href="./inspecaonr-6.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-4 hover:border-teal-500 transition-all flex flex-col justify-between min-h-[130px] md:min-h-[150px] select-none active:scale-[0.98]">
              <div class="flex items-start justify-between">
                <span class="bg-teal-50 text-teal-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider">NR-06</span>
                <div class="w-8 h-8 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-shield-shaded text-sm"></i>
                </div>
              </div>
              <p class="text-xs font-semibold text-slate-600 mt-4 leading-relaxed">
                EPI (Equipamento de Proteção Individual)
              </p>
            </a>

            <a href="./inspecaonr-23.php" class="group bg-slate-50 border border-slate-100 rounded-xl p-4 hover:border-rose-500 transition-all flex flex-col justify-between min-h-[130px] md:min-h-[150px] select-none active:scale-[0.98]">
              <div class="flex items-start justify-between">
                <span class="bg-rose-50 text-rose-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider">NR-23</span>
                <div class="w-8 h-8 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-colors shadow-xs">
                  <i class="bi bi-fire text-sm"></i>
                </div>
              </div>
              <p class="text-xs font-semibold text-slate-600 mt-4 leading-relaxed">
                Proteção Contra Incêndios
              </p>
            </a>
            
          </div>
        </main>

        <section class="bg-white border border-slate-100 rounded-2xl p-4 md:p-6 space-y-3.5 shadow-xs">
          <h2 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Relatórios Recentes</h2>
          <div class="bg-slate-50 border border-slate-100 rounded-xl p-6 md:p-8 text-center flex flex-col items-center justify-center min-h-[160px] md:min-h-[200px]">
            <div class="w-10 h-10 bg-white text-slate-300 rounded-full flex items-center justify-center mb-2 text-base shadow-xs">
              <i class="bi bi-clipboard-x"></i>
            </div>
            <p class="text-xs md:text-sm text-slate-400 font-semibold">Nenhum Relatório Gerado Hoje</p>
          </div>
        </section>

      </div>
    </div>
    
    <?php include './footer.php'; ?>

    <script src="./js/main.js"></script>
  </body>
</html>