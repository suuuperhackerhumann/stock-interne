<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
                <i class="fa-solid fa-users text-red-600"></i> Gestion des Utilisateurs NOVASYS
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Nouvel Utilisateur
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

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-950/40 text-red-800 dark:text-red-300 rounded-lg border border-red-200 dark:border-red-800 text-sm font-medium">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                    <thead class="bg-neutral-100 dark:bg-neutral-900 uppercase text-xs text-neutral-500 font-bold">
                        <tr>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Rôle</th>
                            <th class="p-3">Département</th>
                            <th class="p-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-900/50">
                                <td class="p-3 font-bold text-black dark:text-white">{{ $user->name }}</td>
                                <td class="p-3 font-mono text-neutral-500">{{ $user->email }}</td>
                                <td class="p-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase bg-red-50 dark:bg-red-950/40 text-red-600 border border-red-500/20">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $user->department ?? 'N/A' }}</td>
                                <td class="p-3 text-right">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-neutral-400 hover:text-red-600 transition" title="Supprimer">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-neutral-400 italic">Compte actuel</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>