<?php
require_once __DIR__ . '/../backend/auth.php';
require_once __DIR__ . '/../backend/conexao.php';
checkAuth();

$reportId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$report = null;
$errorMessage = '';

if ($reportId > 0) {
    $stmt = $conn->prepare('SELECT c.*, u.nome AS usuario_nome, u.email AS usuario_email FROM checklists c JOIN usuarios u ON c.criador = u.id WHERE c.id = :id AND c.criador = :criador LIMIT 1');
    $stmt->bindValue(':id', $reportId, PDO::PARAM_INT);
    $stmt->bindValue(':criador', getCurrentUserId(), PDO::PARAM_INT);
    $stmt->execute();
    $report = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$report) {
    $errorMessage = 'Relatório não encontrado ou você não tem permissão para visualizá-lo.';
}

$questionMaps = [
    'nr_10' => [
        'p1' => 'O Prontuário das Instalações Elétricas (PIE) está atualizado e disponível?',
        'p2' => 'Diagramas unifilares das instalações elétricas correspondem à realidade atual?',
        'p3' => 'O Laudo de SPDA (Para-raios) e aterramento está vigente e assinado por Eng. Eletricista?',
        'p4' => 'Os painéis estão íntegros, fechados e sem partes vivas (cabos/barramentos) expostas?',
        'p5' => 'O procedimento LOTO (Lockout/Tagout) possui cadeados individuais para cada eletricista?',
        'p6' => 'Detectores de tensão foram utilizados antes de iniciar qualquer intervenção elétrica?',
        'p7' => 'Os eletricistas usam vestimenta antichama e nível ATPV adequado?',
        'p8' => 'Luvas de borracha isolante foram testadas no dia da inspeção e estão em bom estado?',
        'p9' => 'Treinamento NR-10 e reciclagem dos trabalhadores estão registrados e válidos?',
        'p10' => 'ASO de aptidão para trabalho em instalações elétricas está atualizado e presente?',
    ],
    'nr_06' => [
        'p1' => 'Os EPIs fornecidos possuem Certificado de Aprovação (CA) válido ou estão dentro do prazo de validade do fabricante se adquiridos antes do vencimento do CA?',
        'p2' => 'O registro do fornecimento dos EPIs e das fichas de controle está corretamente preenchido?',
        'p3' => 'O trabalhador recebeu treinamento sobre uso, guarda e conservação dos EPIs entregues?',
        'p4' => 'Há substituição imediata em caso de defeito ou desgaste detectado nos EPIs?',
        'p5' => 'Os trabalhadores usam os EPIs corretamente durante as atividades com risco?',
        'p6' => 'As vestimentas de proteção são fornecidas gratuitamente e possuem registro de entrega?',
        'p7' => 'O cinto paraquedista está em boas condições e engatado corretamente no ponto de ancoragem?',
        'p8' => 'Os equipamentos estão ajustados ao peso, altura e movimentação do trabalhador?',
        'p9' => 'O fator de queda está minimizado por sistemas adequados e inspeção antes do uso?',
        'p10' => 'Foi calculada e mantida a zona livre de queda conforme exigências técnicas?',
    ],
    'nr_23' => [
        'p1' => 'As saídas são suficientes para a rápida e segura retirada do pessoal em caso de emergência?',
        'p2' => 'A largura das saídas atende aos padrões mínimos para evacuação segura?',
        'p3' => 'As saídas estão sinalizadas e desobstruídas com iluminação adequada?',
        'p4' => 'As portas de emergência abrem no sentido de escape e possuem travamento adequado?',
        'p5' => 'As portas corta-fogo e de emergência estão destrancadas e sem obstruções?',
        'p6' => 'Os extintores estão acessíveis, sem obstruções e alocados em locais visíveis?',
        'p7' => 'Os extintores passaram por inspeção e manutenção dentro do prazo exigido?',
        'p8' => 'Há quantidade e tipo de equipamento suficiente para combater o risco de incêndio local?',
        'p9' => 'Existe brigada de incêndio treinada e capacitada para a área inspecionada?',
        'p10' => 'As pessoas estão adestradas para usar equipamentos e agir em situação de emergência?',
    ],
];

$sectorLabels = [
    'nr_10' => 'NR-10 - Instalações Elétricas',
    'nr_06' => 'NR-06 - Equipamento de Proteção Individual',
    'nr_23' => 'NR-23 - Proteção Contra Incêndio',
];

 $reportData = [];
 $summary = ['total' => 0, 'conforme' => 0, 'nao_conforme' => 0, 'nao_selecionado' => 0, 'percentual' => 0];

if ($report) {
  $labels = $questionMaps[$report['setor']] ?? [];

  // Fetch items for this checklist
  $stmtItems = $conn->prepare('SELECT * FROM checklist_items WHERE checklist_id = :id');
  $stmtItems->bindValue(':id', $reportId, PDO::PARAM_INT);
  $stmtItems->execute();
  $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
  $itemsByCampo = [];
  foreach ($items as $it) {
    $itemsByCampo[$it['campo']] = $it;
  }

  // Prepare photo statement
  $stmtPhotos = $conn->prepare('SELECT caminho FROM checklist_photos WHERE checklist_item_id = :item_id ORDER BY id ASC');

  foreach ($labels as $campo => $pergunta) {
    $item = $itemsByCampo[$campo] ?? null;
    $valor = $item['resposta'] ?? 'nao-selecionado';
    if ($valor === 'conforme') {
      $summary['conforme']++;
    } elseif ($valor === 'nao-conforme') {
      $summary['nao_conforme']++;
    } else {
      $summary['nao_selecionado']++;
    }
    $summary['total']++;

    $observacao = $item['observacao'] ?? '';
    $fotoPath = null;
    if ($item) {
      $stmtPhotos->bindValue(':item_id', $item['id'], PDO::PARAM_INT);
      $stmtPhotos->execute();
      $photo = $stmtPhotos->fetch(PDO::FETCH_ASSOC);
      if ($photo) {
        $fotoPath = $photo['caminho'];
      }
    }

    $reportData['itens'][] = [
      'campo' => $campo,
      'pergunta' => $pergunta,
      'valor' => $valor,
      'observacao' => trim($observacao),
      'foto' => $fotoPath,
    ];
  }

  // Calculate percentual
  $reportData['percentual'] = $summary['total'] > 0 ? round(($summary['conforme'] / $summary['total']) * 100) : 0;
  $summary['percentual'] = $reportData['percentual'];
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
    <title>CheckPGR - Relatório</title>
  </head>
  <body class="flex flex-col min-h-screen bg-slate-50 select-none" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">

<?php if ($errorMessage): ?>
    <div class="max-w-[900px] mx-auto px-4 py-8">
      <div class="bg-white border border-rose-200 text-rose-700 rounded-2xl p-6 shadow-sm">
        <h1 class="text-lg font-bold mb-2">Relatório não encontrado</h1>
        <p class="text-sm text-slate-600 mb-4"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="./dashboard.php" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl text-sm">Retornar ao Painel</a>
      </div>
    </div>
<?php else: ?>
    <header class="w-full bg-white shadow-xs border-b border-slate-100 sticky top-0 z-50">
      <div class="max-w-[1200px] mx-auto px-4 py-3 flex items-center justify-between gap-2">
        <div class="flex items-center gap-2 min-w-0">
          <a href="./dashboard.php" class="text-slate-400 hover:text-slate-600 transition-colors p-2 shrink-0 active:scale-95">
            <i class="bi bi-arrow-left text-lg"></i>
          </a>
          <div class="min-w-0">
            <h1 class="text-sm font-bold text-slate-800 truncate">Comprovante de Inspeção</h1>
            <p class="text-[11px] text-slate-400 truncate">Relatório Técnico Gerado</p>
          </div>
        </div>
        <span class="bg-emerald-50 text-emerald-600 font-bold px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider flex items-center gap-1.5 shrink-0">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Finalizado
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
              <p class="text-xs text-slate-400">Abaixo encontra-se o relatório com os dados registrados.</p>
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
                <?php echo strtoupper(substr(getUserName(), 0, 2)); ?>
              </div>
              <h3 class="text-base font-bold text-slate-800"><?php echo htmlspecialchars($sectorLabels[$report['setor']] ?? strtoupper($report['setor']), ENT_QUOTES, 'UTF-8'); ?></h3>
              <p class="text-xs text-slate-400">Relatório armazenado no sistema</p>
            </div>
            <div class="text-left sm:text-right text-xs text-slate-500 space-y-1 sm:mt-0 w-full sm:w-auto">
              <p><strong>Cód. Relatório:</strong> #<?php echo htmlspecialchars($reportId, ENT_QUOTES, 'UTF-8'); ?></p>
              <p><strong>Data:</strong> <?php echo date('d/m/Y - H:i', strtotime($report['created_at'])); ?></p>
              <p><strong>Status:</strong> <?php echo $summary['nao_conforme'] > 0 ? 'Conformidade Parcial' : 'Em Conformidade'; ?></p>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Metadados da Inspeção</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-slate-50 rounded-xl p-4 text-xs sm:text-sm text-slate-600">
              <div class="space-y-1.5">
                <p class="truncate"><strong>Inspetor Responsável:</strong> <?php echo htmlspecialchars(getUserName(), ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="truncate"><strong>E-mail:</strong> <?php echo htmlspecialchars(getUserEmail(), ENT_QUOTES, 'UTF-8'); ?></p>
              </div>
              <div class="space-y-1.5">
                <p class="truncate"><strong>Setor Avaliado:</strong> <?php echo htmlspecialchars($sectorLabels[$report['setor']] ?? strtoupper($report['setor']), ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="truncate"><strong>Validação:</strong> Auditoria Interna</p>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Score de Conformidade</h4>
            <div class="grid grid-cols-3 gap-2 sm:grid-cols-3">
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-emerald-50/30 text-center">
                <p class="text-xl sm:text-2xl font-bold text-emerald-600"><?php echo $summary['percentual']; ?>%</p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Geral</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-slate-50 text-center">
                <p class="text-xl sm:text-2xl font-bold text-slate-700"><?php echo $summary['conforme']; ?></p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Itens OK</p>
              </div>
              <div class="border border-slate-100 rounded-xl p-3 sm:p-4 bg-rose-50/30 text-center">
                <p class="text-xl sm:text-2xl font-bold text-rose-600"><?php echo $summary['nao_conforme']; ?></p>
                <p class="text-[9px] uppercase font-bold text-slate-400 mt-0.5">Irregularidades</p>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400">O que precisa ser arrumado</h4>
            <div class="grid gap-4">
              <?php foreach ($reportData['itens'] as $item): ?>
                <?php if ($item['valor'] === 'nao-conforme' || $item['observacao'] !== ''): ?>
                  <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                      <div class="space-y-1 min-w-0">
                        <p class="text-[10px] uppercase tracking-[0.28em] font-semibold text-slate-400">Item <?php echo htmlspecialchars(substr($item['campo'], 1), ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="font-semibold text-slate-700 text-sm leading-relaxed"><?php echo htmlspecialchars($item['pergunta'], ENT_QUOTES, 'UTF-8'); ?></p>
                      </div>
                      <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $item['valor'] === 'conforme' ? 'bg-emerald-100 text-emerald-700' : ($item['valor'] === 'nao-conforme' ? 'bg-rose-100 text-rose-700' : 'bg-slate-200 text-slate-600'); ?>">
                        <?php echo $item['valor'] === 'conforme' ? 'Conforme' : ($item['valor'] === 'nao-conforme' ? 'Não Conforme' : 'Sem Resposta'); ?>
                      </span>
                    </div>
                    <div class="mt-4 space-y-2 text-sm text-slate-600">
                      <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Observação</p>
                      <p><?php echo $item['observacao'] !== '' ? htmlspecialchars($item['observacao'], ENT_QUOTES, 'UTF-8') : '<span class="text-slate-400">Nenhuma observação registrada</span>'; ?></p>
                    </div>
                    <?php if ($item['foto']): ?>
                      <div class="mt-4">
                        <p class="text-[10px] uppercase tracking-wider text-slate-400 mb-2">Evidência fotográfica</p>
                        <img src="../<?php echo htmlspecialchars($item['foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto item <?php echo htmlspecialchars(substr($item['campo'], 1), ENT_QUOTES, 'UTF-8'); ?>" class="w-full max-w-[320px] h-auto rounded-xl border border-slate-200" />
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
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
<?php endif; ?>

    <?php include './footer.php'; ?>
    
    <script src="./js/main.js"></script>
  </body>
</html>
