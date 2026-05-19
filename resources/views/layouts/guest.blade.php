<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CandidatureTracker') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-10 lg:px-14 xl:px-20 bg-gray-50">
            <div class="w-full max-w-[400px]">
                {{ $slot }}
            </div>
        </div>
        
        <!-- Right Side - Illustration -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-400 relative overflow-hidden">
            <!-- Glow effects -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-white/10 rounded-full blur-[100px]"></div>
            <div class="absolute top-20 right-20 w-72 h-72 bg-teal-300/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-20 w-96 h-96 bg-emerald-300/15 rounded-full blur-3xl"></div>
            
            <div class="flex flex-col justify-center items-center w-full px-12 xl:px-20 relative z-10">
                <!-- Floating Cards -->
                <div class="relative w-full max-w-md">
                    <!-- Card 1 - Doctolib -->
                    <div class="floating-card absolute top-0 left-0 -rotate-[4deg] z-30 animate-float-1" style="animation-delay: 0s;">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">DT</div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">Doctolib</p>
                                <p class="text-xs text-gray-500">Dev Full-Stack</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-medium rounded-full">Entretien</span>
                            <span class="px-2.5 py-1 bg-red-50 text-red-500 text-xs font-medium rounded-full flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"/></svg>
                                Haute
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card 2 - Qonto -->
                    <div class="floating-card absolute top-28 left-20 rotate-[2deg] z-20 animate-float-2" style="animation-delay: 0.5s;">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center text-white font-bold text-sm">QO</div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">Qonto</p>
                                <p class="text-xs text-gray-500">SE — Payments</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-600 text-xs font-medium rounded-full mb-3">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Offre reçue
                        </span>
                        <div class="bg-emerald-50 rounded-xl px-3 py-2.5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/></svg>
                            <span class="text-sm font-semibold text-emerald-700">56k€ + BSPCE</span>
                        </div>
                    </div>
                    
                    <!-- Card 3 - Funnel -->
                    <div class="floating-card absolute top-56 left-10 -rotate-[1deg] z-10 animate-float-3" style="animation-delay: 1s;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">FUNNEL</span>
                            <span class="text-xs font-semibold text-emerald-600">+15% ce mois</span>
                        </div>
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600">Postulé</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-400 rounded-full" style="width: 75%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-900 w-4 text-right">12</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600">Entretien</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-blue-500 rounded-full" style="width: 50%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-900 w-4 text-right">6</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600">Offre</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-emerald-500 rounded-full" style="width: 25%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-900 w-4 text-right">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Spacer for cards -->
                    <div class="h-80"></div>
                </div>
                
                <!-- Quote -->
                <div class="text-center mt-12 max-w-[320px]">
                    <p class="text-white text-[26px] font-bold leading-[1.2] mb-4">
                        « Chaque candidature<br>compte. Suis-les toutes. »
                    </p>
                    <p class="text-white/85 text-sm leading-relaxed">
                        Centralise tes candidatures, garde un œil sur tes entretiens<br>
                        et ne laisse plus jamais une opportunité passer.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes float-1 {
            0%, 100% { transform: translateY(0px) rotate(-4deg); }
            50% { transform: translateY(-10px) rotate(-4deg); }
        }
        @keyframes float-2 {
            0%, 100% { transform: translateY(0px) rotate(2deg); }
            50% { transform: translateY(-8px) rotate(2deg); }
        }
        @keyframes float-3 {
            0%, 100% { transform: translateY(0px) rotate(-1deg); }
            50% { transform: translateY(-12px) rotate(-1deg); }
        }
        .animate-float-1 { animation: float-1 4s ease-in-out infinite; }
        .animate-float-2 { animation: float-2 5s ease-in-out infinite; }
        .animate-float-3 { animation: float-3 6s ease-in-out infinite; }
    </style>
</body>
</html>
