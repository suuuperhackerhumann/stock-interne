<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
                <i class="fa-solid fa-key text-red-600"></i> Gestion des Licences & Abonnements
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.licenses.create') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Nouvelle Licence
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

            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                    <thead class="bg-neutral-100 dark:bg-neutral-900 uppercase text-xs text-neutral-500 font-bold">
                        <tr>
                            <th class="p-3">Nom / Logiciel</th>
                            <th class="p-3">Clé de Licence</th>
                            <th class="p-3">Catégorie</th>
                            <th class="p-3">Utilisées / Total</th>
                            <th class="p-3">Expiration</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($licenses as $license)
                            <tr class="border-b border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
                                <td class="p-3 font-bold text-black dark:text-white">{{ $license->name }}</td>
                                <td class="p-3 font-mono text-red-600">{{ $license->license_key }}</td>
                                <td class="p-3">{{ $license->category->name ?? 'N/A' }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded text-xs font-bold bg-neutral-100 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200">
                                        {{ $license->used_seats ?? 0 }} / {{ $license->total_seats }}
                                    </span>
                                </td>
                                <td class="p-3 text-xs font-mono">
                                    {{ $license->expiration_date ? \Carbon\Carbon::parse($license->expiration_date)->format('d/m/Y') : 'Illimité' }}
                                </td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('admin.licenses.edit', $license->id) }}" class="p-2 text-neutral-400 hover:text-amber-600 transition" title="Modifier">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.licenses.destroy', $license->id) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer cette licence ?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-neutral-400 hover:text-red-600 transition" title="Supprimer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-8 text-center italic text-neutral-400">Aucune licence enregistrée dans le système.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $licenses->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>