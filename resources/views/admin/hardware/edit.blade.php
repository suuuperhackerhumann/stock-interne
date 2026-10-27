<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black dark:text-white flex items-center gap-3">
            <i class="fa-solid fa-pen-to-square text-amber-600"></i> Modifier l'équipement : {{ $hardware->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-[#0a0a0a] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#111111] shadow-sm border border-neutral-200 dark:border-neutral-800 rounded-lg p-6">
                
                <form action="{{ route('admin.hardware.update', $hardware->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Nom / Modèle du matériel</label>
                        <input type="text" name="name" value="{{ old('name', $hardware->name) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Numéro de Série / S/N</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number', $hardware->serial_number) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white font-mono focus:border-red-600 focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Catégorie</label>
                            <select name="category_id" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $hardware->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Statut</label>
                            <select name="status" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                                <option value="disponible" {{ $hardware->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="attribue" {{ $hardware->status == 'attribue' ? 'selected' : '' }}>Attribué</option>
                                <option value="en_panne" {{ $hardware->status == 'en_panne' ? 'selected' : '' }}>En panne</option>
                                <option value="reforme" {{ $hardware->status == 'reforme' ? 'selected' : '' }}>Réformé</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Emplacement Stock</label>
                            <input type="text" name="location" value="{{ old('location', $hardware->location) }}" required class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase text-neutral-600 dark:text-neutral-400 mb-1">Date d'achat</label>
                        <input type="date" name="purchase_date" value="{{ old('purchase_date', $hardware->purchase_date ? \Carbon\Carbon::parse($hardware->purchase_date)->format('Y-m-d') : '') }}" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg px-4 py-2 text-sm text-black dark:text-white focus:border-red-600 focus:ring-0">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-neutral-200 dark:border-neutral-800">
                        <a href="{{ route('admin.hardware.index') }}" class="px-4 py-2 bg-neutral-200 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200 rounded-lg text-sm font-semibold">Annuler</a>
                        <button type="submit" class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-sm font-semibold transition">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>