<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('images/logo_novasys.png') }}">
        <title>NOVASYS - Gestion de Stock Interne</title>

        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */ @layer properties{*,:before,:after,::backdrop{--tw-translate-x:0;--tw-translate-y:0;--tw-translate-z:0;--tw-rotate-x:initial;--tw-rotate-y:initial;--tw-rotate-z:initial;--tw-skew-x:initial;--tw-skew-y:initial;--tw-space-x-reverse:0;--tw-border-style:solid;--tw-leading:initial;--tw-font-weight:initial;--tw-tracking:initial;--tw-shadow:0 0 #0000;--tw-shadow-color:initial;--tw-shadow-alpha:100%;--tw-inset-shadow:0 0 #0000;--tw-inset-shadow-color:initial;--tw-inset-shadow-alpha:100%;--tw-ring-color:initial;--tw-ring-shadow:0 0 #0000;--tw-inset-ring-color:initial;--tw-inset-ring-shadow:0 0 #0000;--tw-ring-inset:initial;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-offset-shadow:0 0 #0000;--tw-blur:initial;--tw-brightness:initial;--tw-contrast:initial;--tw-grayscale:initial;--tw-hue-rotate:initial;--tw-invert:initial;--tw-opacity:initial;--tw-saturate:initial;--tw-sepia:initial;--tw-drop-shadow:initial;--tw-drop-shadow-color:initial;--tw-drop-shadow-alpha:100%;--tw-drop-shadow-size:initial;--tw-duration:initial;--tw-ease:initial;--tw-content:""}}
            </style>
        @endif
    </head>
    <body class="bg-white dark:bg-black text-black dark:text-white flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans">
        
        <!-- Navigation Supérieure -->
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between gap-4">
                    <div class="font-bold tracking-wider text-red-600 uppercase text-base">
                        NOVASYS <span class="text-black dark:text-white font-light">Stock Manager</span>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 border border-black dark:border-white hover:bg-red-600 hover:border-red-600 hover:text-white rounded-sm text-sm font-medium transition"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="inline-block px-5 py-1.5 border border-black/20 dark:border-white/20 hover:border-red-600 hover:text-red-600 rounded-sm text-sm font-medium transition"
                            >
                                Connexion
                            </a>
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <!-- Contenu Principal -->
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row shadow-2xl rounded-xl overflow-hidden border border-black/10 dark:border-white/10">
                
                <!-- Section Texte (Gauche) -->
                <div class="flex-1 p-6 pb-6 lg:p-12 lg:pb-10 bg-white dark:bg-[#111111] dark:text-white flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-widest text-red-600 bg-red-50 dark:bg-red-950/50 px-2.5 py-1 rounded">
                            Solution Interne
                        </span>
                        <h1 class="mt-4 mb-2 text-2xl font-bold tracking-tight">Gestion du Matériel & Licences</h1>
                        <p class="mb-6 text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                            Plateforme officielle de suivi, d'attribution et de traçabilité des équipements informatiques pour les équipes de NOVASYS.
                        </p>
                        
                        <ul class="flex flex-col gap-3 mb-8 text-sm text-neutral-700 dark:text-neutral-300">
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                <span>Suivi en temps réel des stocks et emplacements</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                <span>Attribution sécurisée par profil (Admin, Logistique, Employé)</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                <span>Génération automatique des fiches de décharge PDF</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-block px-6 py-3 bg-red-600 text-white hover:bg-black rounded-sm font-semibold text-sm transition shadow-md text-center w-full">
                                Accéder à mon Tableau de Bord
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-black dark:bg-white text-white dark:text-black hover:bg-red-600 dark:hover:bg-red-600 dark:hover:text-white rounded-sm font-semibold text-sm transition shadow-md text-center w-full">
                                Se connecter au système
                            </a>
                        @endauth
                        
                        <p class="mt-4 text-neutral-400 text-xs text-center">
                            NOVASYS © {{ date('Y') }} — We Secure Your Business
                        </p>
                    </div>
                </div>

                <!-- Section Logo & Visuel (Droite) -->
                <div class="bg-gradient-to-br from-red-50 via-rose-100 to-red-200 dark:from-neutral-950 dark:via-red-950/40 dark:to-black relative lg:-ml-px -mb-px lg:mb-0 aspect-[335/364] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center p-8">
                    <!-- Affichage du Logo NOVASYS -->
                    <div class="bg-white/80 dark:bg-black/60 backdrop-blur-md p-8 rounded-xl shadow-lg border border-red-500/20 w-full flex flex-col items-center justify-center text-center">
                        <img src="{{ asset('images/logo_novasys.png') }}" alt="Logo NOVASYS" class="max-h-24 w-auto object-contain mb-4">
                        <div class="h-0.5 w-16 bg-red-600 mb-3"></div>
                        <p class="text-xs font-semibold tracking-wider uppercase text-neutral-600 dark:text-neutral-400">
                            We Secure Your Business
                        </p>
                    </div>
                </div>

            </main>
        </div>

    </body>
</html>