<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
                <i class="fa-solid fa-chart-line text-red-600"></i> Rapports & Traçabilité des Mouvements
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold hover:bg-neutral-300 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Retour
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-lg text-black dark:text-white">Journal d'Audit</h3>
                        <p class="text-xs text-neutral-500 mt-1">Historique en temps réel des créations, attributions et modifications du stock.</p>
                    </div>
                    <span class="px-3 py-1 bg-red-50 dark:bg-red-950/40 text-red-600 text-xs font-bold rounded-full border border-red-500/20">
                        <i class="fa-solid fa-shield-halved mr-1"></i> Audit actif
                    </span>
                </div>

                <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                    <thead class="bg-neutral-100 dark:bg-neutral-900 uppercase text-xs text-neutral-500 font-bold">
                        <tr>
                            <th class="p-3">Date & Heure</th>
                            <th class="p-3">Auteur</th>
                            <th class="p-3">Action</th>
                            <th class="p-3">Élément</th>
                            <th class="p-3">Détail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="border-b border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
                                <td class="p-3 font-mono text-xs text-neutral-500">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 font-bold text-black dark:text-white">{{ $log->user->name ?? 'Système' }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                        {{ $log->action === 'ENTREE' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $log->action === 'ATTRIBUTION' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $log->action === 'SUPPRESSION' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $log->action === 'MODIFICATION' ? 'bg-amber-100 text-amber-800' : '' }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="p-3 font-semibold text-black dark:text-white">{{ $log->item_name }}</td>
                                <td class="p-3 text-xs text-neutral-500">{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-neutral-400 italic">
                                    <i class="fa-solid fa-folder-open text-3xl mb-2 text-neutral-300"></i>
                                    <p>Aucun événement enregistré dans le journal d'audit pour le moment.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if(method_exists($logs, 'links'))
                    <div class="mt-4">{{ $logs->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>