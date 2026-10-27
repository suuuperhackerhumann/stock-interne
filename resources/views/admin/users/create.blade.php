<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
            <i class="fa-solid fa-user-plus text-red-600"></i> Ajouter un Collaborateur NOVASYS
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nom complet</label>
                        <input type="text" name="name" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Email (@novasys.stock)</label>
                        <input type="email" name="email" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0" placeholder="exemple@novasys.stock">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Rôle</label>
                            <select name="role" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                                <option value="employee">Employé</option>
                                <option value="distributor">Distributeur (Logistique)</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Département</label>
                            <input type="text" name="department" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0" placeholder="ex: Direction IT">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Mot de passe temporaire</label>
                        <input type="password" name="password" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0" value="password">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold">Annuler</a>
                        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>