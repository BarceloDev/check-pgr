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
    <title>CheckPGR - Login</title>
  </head>
  <body class="flex min-h-screen items-center justify-center p-4 select-none" style="background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px); background-size: 16px 16px;">
    
    <main class="w-full max-w-md bg-white rounded-2xl shadow-xs border border-slate-100 p-5 sm:p-8">
      <div class="text-center mb-6 sm:mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-xl mb-3 text-xl">
          <i class="bi bi-shield-check"></i>
        </div>
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Login</h1>
      </div>

      <form action="./dashboard.php" class="space-y-4 sm:space-y-5" autocomplete="off">
        
        <div>
          <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Nome e Sobrenome</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
              <i class="bi bi-person"></i>
            </span>
            <input 
              type="text" 
              placeholder="Nome Sobrenome" 
              required 
              autocorrect="off"
              autocapitalize="words"
              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
            />
          </div>
        </div>

        <div>
          <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">E-mail corporativo</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
              <i class="bi bi-envelope"></i>
            </span>
            <input 
              type="email" 
              placeholder="usuario@empresa.com" 
              required 
              autocorrect="off"
              autocapitalize="none"
              inputmode="email"
              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
            />
          </div>
        </div>

        <div>
          <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Senha</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
              <i class="bi bi-lock"></i>
            </span>
            <input 
              type="password" 
              placeholder="••••••••" 
              required 
              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all"
            />
          </div>
        </div>

        <button 
          type="submit" 
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3.5 text-sm transition-all cursor-pointer shadow-sm shadow-blue-100 active:scale-[0.98]"
        >
          Entrar no Sistema
        </button>
      </form>

      <div class="text-center mt-6">
        <a href="./cadastro.php" class="inline-block text-xs text-blue-600 hover:underline font-semibold py-1 -webkit-tap-highlight-color-transparent">
          Não tem uma conta? Clique aqui
        </a>
      </div>
    </main>

    <script src="./js/main.js"></script>
  </body>
</html>