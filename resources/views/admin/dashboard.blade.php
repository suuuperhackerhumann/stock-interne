<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-black dark:text-white tracking-tight flex items-center gap-3">
                    <span class="p-2 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-lg border border-red-500/20">
                        <i class="fa-solid fa-gauge-high"></i>
                    </span>
                    {{ __('Administration — Tableau de Bord') }}
                </h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                    NOVASYS — Supervision globale du stock, des utilisateurs et des attributions matérielles.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 bg-neutral-100 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 text-xs font-semibold rounded-full border border-neutral-200 dark:border-neutral-700">
                    <i class="fa-solid fa-shield-halved text-red-600 mr-2"></i> Rôle : Administrateur
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen transition-colors">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- STATS CARDS (CLIQUABLES) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Carte 1 : Matériels -->
                <a href="{{ route('admin.hardware.index') }}" class="block bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-red-500/50 transition group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Total Matériels</p>
                            <h3 class="text-2xl font-black text-black dark:text-white mt-1">{{ $totalHardware }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-lg group-hover:scale-110 transition">
                            <i class="fa-solid fa-server text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-neutral-500 dark:text-neutral-400">
                        <span class="text-emerald-600 font-bold flex items-center mr-1.5"><i class="fa-solid fa-arrow-right mr-1"></i> Consulter</span> le catalogue matériel
                    </div>
                </a>

                <!-- Carte 2 : Licences -->
                <a href="{{ route('admin.licenses.index') }}" class="block bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-red-500/50 transition group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Licences Actives</p>
                            <h3 class="text-2xl font-black text-black dark:text-white mt-1">{{ $totalLicenses }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-lg group-hover:scale-110 transition">
                            <i class="fa-solid fa-key text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-neutral-500 dark:text-neutral-400">
                        <span class="text-emerald-600 font-bold flex items-center mr-1.5"><i class="fa-solid fa-arrow-right mr-1"></i> Gérer</span> les clés & abonnements
                    </div>
                </a>

                <!-- Carte 3 : Utilisateurs -->
                <a href="{{ route('admin.users.index') }}" class="block bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-red-500/50 transition group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Utilisateurs</p>
                            <h3 class="text-2xl font-black text-black dark:text-white mt-1">{{ $totalUsers }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-lg group-hover:scale-110 transition">
                            <i class="fa-solid fa-users text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-neutral-500 dark:text-neutral-400">
                        <span class="text-emerald-600 font-bold flex items-center mr-1.5"><i class="fa-solid fa-arrow-right mr-1"></i> Voir</span> les comptes & rôles
                    </div>
                </a>

                <!-- Carte 4 : Fiches de Décharge -->
                <a href="{{ route('admin.assignments.index') }}" class="block bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-red-500/50 transition group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Fiches de Décharge</p>
                            <h3 class="text-2xl font-black text-black dark:text-white mt-1">{{ $totalAssignments }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-lg group-hover:scale-110 transition">
                            <i class="fa-solid fa-file-pdf text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-neutral-500 dark:text-neutral-400">
                        <span class="text-red-600 font-bold flex items-center mr-1.5"><i class="fa-solid fa-arrow-right mr-1"></i> Générer / Imprimer</span> PDF
                    </div>
                </a>
            </div>

            <!-- SECTION PANNEAU DE CONTRÔLE & ACTIVITÉS RÉCENTES -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Panneau de Contrôle Avancé -->
                <div class="lg:col-span-2 bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm">
                    <h3 class="text-lg font-bold text-black dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-toolbox text-red-600"></i> Panneau de Contrôle Avancé
                    </h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-6">
                        Accédez rapidement aux fonctions de gestion et de contrôle du parc informatique NOVASYS.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.users.index') }}" class="p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 hover:border-red-600 transition flex items-start gap-4 group bg-neutral-50/50 dark:bg-neutral-900/50">
                            <div class="p-3 bg-black dark:bg-white text-white dark:text-black rounded-md group-hover:bg-red-600 dark:group-hover:bg-red-600 dark:group-hover:text-white transition">
                                <i class="fa-solid fa-users-gear text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-black dark:text-white text-sm group-hover:text-red-600 transition">Gestion des Utilisateurs</h4>
                                <p class="text-xs text-neutral-500 mt-1">Ajouter, modifier ou supprimer les comptes (Admin, Distributeur, Employé).</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.hardware.index') }}" class="p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 hover:border-red-600 transition flex items-start gap-4 group bg-neutral-50/50 dark:bg-neutral-900/50">
                            <div class="p-3 bg-black dark:bg-white text-white dark:text-black rounded-md group-hover:bg-red-600 dark:group-hover:bg-red-600 dark:group-hover:text-white transition">
                                <i class="fa-solid fa-boxes-stacked text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-black dark:text-white text-sm group-hover:text-red-600 transition">Catalogue du Stock</h4>
                                <p class="text-xs text-neutral-500 mt-1">Superviser et mettre à jour les équipements et licences logicielles.</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.assignments.index') }}" class="p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 hover:border-red-600 transition flex items-start gap-4 group bg-neutral-50/50 dark:bg-neutral-900/50">
                            <div class="p-3 bg-black dark:bg-white text-white dark:text-black rounded-md group-hover:bg-red-600 dark:group-hover:bg-red-600 dark:group-hover:text-white transition">
                                <i class="fa-solid fa-file-invoice text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-black dark:text-white text-sm group-hover:text-red-600 transition">Fiches de Décharge PDF</h4>
                                <p class="text-xs text-neutral-500 mt-1">Générer et consulter les remises officielles d'équipements.</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.logs.index') }}" class="p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 hover:border-red-600 transition flex items-start gap-4 group bg-neutral-50/50 dark:bg-neutral-900/50">
                            <div class="p-3 bg-black dark:bg-white text-white dark:text-black rounded-md group-hover:bg-red-600 dark:group-hover:bg-red-600 dark:group-hover:text-white transition">
                                <i class="fa-solid fa-chart-line text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-black dark:text-white text-sm group-hover:text-red-600 transition">Rapports & Logs</h4>
                                <p class="text-xs text-neutral-500 mt-1">Consulter l'historique complet et les traçabilités des mouvements.</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Matériels Récents -->
                <div class="bg-white dark:bg-[#111111] p-6 rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-black dark:text-white mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-laptop text-red-600"></i> Matériels Récents
                        </h3>
                        <div class="space-y-4">
                            @forelse ($recentHardware as $item)
                                <div class="flex items-start gap-3 pb-3 border-b border-neutral-100 dark:border-neutral-800">
                                    <div class="p-2 bg-red-50 dark:bg-red-950/40 text-red-600 rounded-full mt-0.5">
                                        <i class="fa-solid fa-microchip text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs font-semibold text-black dark:text-white">{{ $item->name }}</p>
                                            <span class="text-[10px] px-1.5 py-0.5 bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 rounded font-mono">{{ $item->serial_number }}</span>
                                        </div>
                                        <p class="text-[11px] text-neutral-500 mt-0.5">Statut : <span class="text-emerald-600 font-medium">{{ ucfirst($item->status) }}</span></p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-neutral-500 italic">Aucun matériel enregistré pour le moment.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <div class="bg-red-600 text-white p-4 rounded-lg text-center shadow-md">
                            <i class="fa-solid fa-headset mb-2 text-xl"></i>
                            <h4 class="font-bold text-sm">Support Technique NOVASYS</h4>
                            <p class="text-xs text-red-100 mt-1">Riviera 3, Abidjan — Agence Interne</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>