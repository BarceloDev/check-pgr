<?php
require_once __DIR__ . '/../backend/auth.php';
require_once __DIR__ . '/../backend/conexao.php';
checkAuth();

$userId = getCurrentUserId();
$sectorLabels = [
    'nr_10' => 'NR-10 - Instalações Elétricas',
    'nr_06' => 'NR-06 - Equipamento de Proteção Individual',
    'nr_23' => 'NR-23 - Proteção Contra Incêndio',
];

$stmt = $conn->prepare('SELECT * FROM checklists WHERE criador = :criador ORDER BY created_at DESC LIMIT 8');
$stmt->bindValue(':criador', $userId, PDO::PARAM_INT);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
$reportItems = [];

foreach ($reports as $report) {
  $conforme = 0;
  $naoConforme = 0;
  $total = 0;

  $stmtItems = $conn->prepare('SELECT resposta, COUNT(*) AS cnt FROM checklist_items WHERE checklist_id = :id GROUP BY resposta');
  $stmtItems->bindValue(':id', $report['id'], PDO::PARAM_INT);
  $stmtItems->execute();
  $rows = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $r) {
    $res = $r['resposta'];
    $cnt = (int) $r['cnt'];
    if ($res === 'conforme') {
      $conforme += $cnt;
    } elseif ($res === 'nao-conforme') {
      $naoConforme += $cnt;
    }
    $total += $cnt;
  }

  $percentual = $total > 0 ? round(($conforme / $total) * 100) : 0;
  $reportItems[] = [
    'id' => $report['id'],
    'setor' => $sectorLabels[$report['setor']] ?? strtoupper($report['setor']),
    'created_at' => $report['created_at'],
    'conforme' => $conforme,
    'nao_conforme' => $naoConforme,
    'percentual' => $percentual,
  ];
}
?>

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
            <?php echo strtoupper(substr(getUserName(), 0, 2)); ?>
          </div>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Olá, <?php echo htmlspecialchars(getUserName(), ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-[11px] text-slate-400 truncate"><?php echo htmlspecialchars(getUserEmail(), ENT_QUOTES, 'UTF-8'); ?></p>
          </div>
        </div>
        <a href="../backend/logout.php" class="text-slate-400 hover:text-rose-500 transition-colors p-2 shrink-0 active:scale-95">
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
          <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <div>
              <h2 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Relatórios Recentes</h2>
              <p class="text-xs text-slate-500 mt-1">Histórico das inspeções já enviadas. Apenas visualização, sem edição.</p>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-2 text-[10px] font-semibold uppercase tracking-wider text-slate-500">
              <?php echo count($reportItems); ?> relatório(s) encontrados
            </span>
          </div>

          <?php if (count($reportItems) === 0): ?>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-6 md:p-8 text-center flex flex-col items-center justify-center min-h-[160px] md:min-h-[200px]">
              <div class="w-10 h-10 bg-white text-slate-300 rounded-full flex items-center justify-center mb-2 text-base shadow-xs">
                <i class="bi bi-clipboard-x"></i>
              </div>
              <p class="text-xs md:text-sm text-slate-400 font-semibold">Nenhum relatório salvo ainda.</p>
            </div>
          <?php else: ?>
            <div class="grid grid-cols-1 gap-3 mt-3">
              <?php foreach ($reportItems as $item): ?>
                <article class="border border-slate-100 rounded-2xl p-4 md:p-5 hover:shadow-sm transition-shadow bg-slate-50">
                  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="space-y-1">
                      <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold"><?php echo htmlspecialchars($item['setor'], ENT_QUOTES, 'UTF-8'); ?></p>
                      <h3 class="text-sm font-semibold text-slate-800">Relatório #<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?></h3>
                      <p class="text-[11px] text-slate-500">Gerado em <?php echo date('d/m/Y H:i', strtotime($item['created_at'])); ?></p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                      <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-semibold text-emerald-700">
                        <i class="bi bi-check2-circle text-xs"></i> <?php echo $item['conforme']; ?> OK
                      </span>
                      <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1 text-[10px] font-semibold text-rose-700">
                        <i class="bi bi-exclamation-circle text-xs"></i> <?php echo $item['nao_conforme']; ?> Irreg.
                      </span>
                      <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[10px] font-semibold text-slate-600">
                        <?php echo $item['percentual']; ?>%
                      </span>
                    </div>
                  </div>
                  <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-[11px] text-slate-500">Visualize o relatório salvo sem possibilidade de alteração.</p>
                    <a href="./relatorio.php?id=<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>" class="inline-flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold py-2 px-4 transition-colors">Visualizar</a>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </section>

      </div>
    </div>
    
    <?php include './footer.php'; ?>

    <script src="./js/main.js"></script>
  </body>
</html>