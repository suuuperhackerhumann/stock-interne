<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
                <i class="fa-solid fa-server text-red-600"></i> Catalogue & Stock Matériel
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.hardware.create') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Nouveau Matériel
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold hover:bg-neutral-300 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-100 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 rounded-lg border border-emerald-200 dark:border-emerald-800 text-sm font-medium">
                    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-[#111111] overflow-hidden shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                    <thead class="bg-neutral-100 dark:bg-neutral-900 uppercase text-xs text-neutral-500 font-bold">
                        <tr>
                            <th class="p-3">Numéro de Série</th>
                            <th class="p-3">Désignation</th>
                            <th class="p-3">Catégorie</th>
                            <th class="p-3">Statut</th>
                            <th class="p-3">Emplacement</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hardwareItems as $item)
                            <tr class="border-b border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
                                <td class="p-3 font-mono font-bold text-red-600">{{ $item->serial_number }}</td>
                                <td class="p-3 font-bold text-black dark:text-white">{{ $item->name }}</td>
                                <td class="p-3">{{ $item->category->name ?? 'N/A' }}</td>
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase 
                                        {{ $item->status === 'disponible' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' : '' }}
                                        {{ $item->status === 'attribue' ? 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400' : '' }}
                                        {{ $item->status === 'en_panne' ? 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' : '' }}
                                        {{ $item->status === 'reforme' ? 'bg-red-100 text-red-700 dark:bg-red-950/40 dark:text-red-400' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $item->location }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('admin.hardware.edit', $item->id) }}" class="p-2 text-neutral-400 hover:text-amber-600 transition" title="Modifier">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.hardware.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment retirer cet équipement du stock ?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-neutral-400 hover:text-red-600 transition" title="Supprimer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-8 text-center italic text-neutral-400">Aucun matériel trouvé dans le stock.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $hardwareItems->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>