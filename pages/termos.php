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
    <title>CheckPGR - Termos de Uso</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50 select-none" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <header class="w-full bg-white shadow-xs border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <a href="javascript:history.back()" class="text-slate-400 hover:text-slate-600 transition-colors p-2 -ml-2 shrink-0 active:scale-95">
            <i class="bi bi-arrow-left text-lg"></i>
          </a>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Termos de Uso</h1>
            <p class="text-[11px] text-slate-400 truncate">Aviso Legal e Responsabilidades</p>
          </div>
        </div>
        
        <span class="bg-slate-100 text-slate-600 font-semibold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider shrink-0">
          Institucional
        </span>
      </div>
    </header>

    <div class="flex-1 w-full flex justify-center py-4 md:py-8">
      <main class="w-full max-w-[800px] bg-white border border-slate-100 rounded-2xl p-4 sm:p-8 shadow-xs space-y-5 sm:space-y-6">
        
        <section class="space-y-1.5">
          <h2 class="text-base sm:text-lg font-bold text-slate-800">1. Natureza do Serviço</h2>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            O <strong>CheckPGR</strong> é uma plataforma estritamente digital desenvolvida para atuar como ferramenta de apoio visual e guia eletrônico na execução de checklists de segurança do trabalho (como as Normas Regulamentadoras NR-10, NR-6 e NR-23). A aplicação visa otimizar a coleta de dados e a organização de relatórios pelos inspetores.
          </p>
        </section>

        <section class="space-y-1.5">
          <h2 class="text-base sm:text-lg font-bold text-slate-800">2. Isenção Total de Responsabilidade Técnica</h2>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Por se tratar de um facilitador tecnológico de triagem gráfica, a plataforma, seus desenvolvedores, proprietários e mantenedores <strong>notadamente não assumem qualquer responsabilidade técnica, civil ou criminal</strong> por:
          </p>
          <ul class="list-disc list-outside text-xs sm:text-sm text-slate-600 pl-5 space-y-2 leading-relaxed">
            <li>Acidentes de trabalho, lesões corporais, sinistros, incêndios ou óbitos ocorridos nas dependências das empresas inspecionadas;</li>
            <li>Falhas mecânicas, estruturais ou elétricas em equipamentos validados ou negligenciados durante o uso do checklist;</li>
            <li>Erros de julgamento, omissões de dados ou preenchimento incorreto das informações por parte do inspetor responsável;</li>
            <li>Multas, autuações ou sanções administrativas aplicadas por órgãos fiscalizadores do trabalho.</li>
          </ul>
        </section>

        <section class="space-y-1.5">
          <h2 class="text-base sm:text-lg font-bold text-slate-800">3. Responsabilidade do Usuário</h2>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            É de inteira e exclusiva responsabilidade do inspetor técnico, engenheiro ou profissional de SESMT validar <em>in loco</em> as condições reais de segurança do ambiente. A assinatura e emissão do relatório final gerado pelo sistema possuem caráter informativo e de registro interno, não substituindo laudos periciais assinados por profissionais legalmente habilitados com suas respectivas ARTs (Anotações de Responsabilidade Técnica).
          </p>
        </section>

        <section class="space-y-1.5">
          <h2 class="text-base sm:text-lg font-bold text-slate-800">4. Aceite dos Termos</h2>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            Ao utilizar o sistema, criar uma conta e submeter formulários de inspeção, o usuário e a empresa contratante declaram ciência inequívoca e concordância integral com todas as cláusulas de isenção de responsabilidade dispostas neste documento.
          </p>
        </section>

        <div class="pt-4 sm:pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end">
          <a href="javascript:history.back()" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3.5 px-6 text-sm transition-all cursor-pointer shadow-sm shadow-blue-100 active:scale-[0.98]">
            Entendi e Aceito
          </a>
        </div>

      </main>
    </div>

    <?php include './footer.php'; ?>

    <script src="./js/main.js"></script>
  </body>
</html>