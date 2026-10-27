<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HardwareItem;
use App\Models\License;
use App\Models\User;
use App\Models\Assignment;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    // 1. Vue principale du tableau de bord
    public function index()
    {
        $totalHardware = HardwareItem::count();
        $totalLicenses = License::count();
        $totalUsers = User::count();
        $totalAssignments = class_exists(Assignment::class) ? Assignment::count() : 0;

        $recentHardware = HardwareItem::with('category')->latest()->take(3)->get();
        $recentUsers = User::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalHardware',
            'totalLicenses',
            'totalUsers',
            'totalAssignments',
            'recentHardware',
            'recentUsers'
        ));
    }

    // 2. Gestion du Matériel / Catalogue Stock
    public function hardware()
    {
        $hardwareItems = HardwareItem::with('category')->latest()->paginate(10);
        return view('admin.hardware.index', compact('hardwareItems'));
    }

    // --- GESTION DES LICENCES (CRUD) ---

    // 1. Liste des licences
    public function licenses()
    {
        $licenses = License::with('category')->latest()->paginate(10);
        return view('admin.licenses.index', compact('licenses'));
    }

    // 2. Formulaire de création de licence
    public function createLicense()
    {
        $categories = Category::all();
        return view('admin.licenses.create', compact('categories'));
    }

    // 3. Enregistrement d'une nouvelle licence + Log
    public function storeLicense(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_key' => 'required|string|max:255|unique:licenses,license_key',
            'category_name' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
        ]);

        // Gestion de la catégorie à la volée (comme pour le matériel)
        $category = Category::firstOrCreate(
            ['name' => trim($request->category_name)],
            ['type' => 'license']
        );

        $license = License::create([
            'name' => $request->name,
            'license_key' => $request->license_key,
            'category_id' => $category->id,
            'total_seats' => $request->total_seats,
            'used_seats' => 0,
            'expiration_date' => $request->expiration_date,
        ]);

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'ENTREE',
                'item_type' => 'Licence',
                'item_name' => $license->name,
                'description' => 'Ajout de la licence logicielle "' . $license->name . '" (Postes : ' . $license->total_seats . ')',
            ]);
        }

        return redirect()->route('admin.licenses.index')->with('success', 'Licence enregistrée avec succès.');
    }

    // 4. Formulaire de modification de licence
    public function editLicense(License $license)
    {
        $categories = Category::all();
        return view('admin.licenses.edit', compact('license', 'categories'));
    }

    // 5. Mise à jour de la licence + Log
    public function updateLicense(Request $request, License $license)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_key' => 'required|string|max:255|unique:licenses,license_key,' . $license->id,
            'category_name' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
        ]);

        $category = Category::firstOrCreate(
            ['name' => trim($request->category_name)],
            ['type' => 'license']
        );

        $license->update([
            'name' => $request->name,
            'license_key' => $request->license_key,
            'category_id' => $category->id,
            'total_seats' => $request->total_seats,
            'expiration_date' => $request->expiration_date,
        ]);

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'MODIFICATION',
                'item_type' => 'Licence',
                'item_name' => $license->name,
                'description' => 'Mise à jour de la licence "' . $license->name . '" (Postes max : ' . $license->total_seats . ')',
            ]);
        }

        return redirect()->route('admin.licenses.index')->with('success', 'Licence mise à jour avec succès.');
    }

    // 6. Suppression de la licence + Log
    public function destroyLicense(License $license)
    {
        $licenseName = $license->name;
        $license->delete();

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'SUPPRESSION',
                'item_type' => 'Licence',
                'item_name' => $licenseName,
                'description' => 'Suppression définitive de la licence "' . $licenseName . '"',
            ]);
        }

        return back()->with('success', 'Licence supprimée du système.');
    }

    // 4. Liste des Utilisateurs
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 5. Formulaire d'ajout d'un utilisateur
    public function createUser()
    {
        return view('admin.users.create');
    }

    // 6. Enregistrement d'un utilisateur + Log automatique
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,distributor,employee',
            'department' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'ENTREE',
                'item_type' => 'Utilisateur',
                'item_name' => $newUser->name,
                'description' => 'Création du compte utilisateur (' . $newUser->email . ') avec le rôle ' . strtoupper($newUser->role),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // 7. Suppression d'un utilisateur + Log automatique
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $userName = $user->name;
        $userEmail = $user->email;
        $user->delete();

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'SUPPRESSION',
                'item_type' => 'Utilisateur',
                'item_name' => $userName,
                'description' => 'Suppression du compte utilisateur (' . $userEmail . ')',
            ]);
        }

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    // 8. Fiches de Décharge
    public function assignments()
    {
        $assignments = class_exists(Assignment::class) 
            ? Assignment::with(['user', 'hardwareItem'])->latest()->paginate(10) 
            : collect();

        return view('admin.assignments.index', compact('assignments'));
    }

    // 9. Rapports & Journal d'audit (Logs)
    public function logs()
    {
        $logs = class_exists(StockLog::class)
            ? StockLog::with('user')->latest()->paginate(15)
            : collect();

        return view('admin.logs.index', compact('logs'));
    }

    // --- GESTION DU MATÉRIEL (CRUD) ---

    // Formulaire d'ajout d'équipement
    public function createHardware()
    {
        $categories = Category::where('type', 'hardware')->get();
        return view('admin.hardware.create', compact('categories'));
    }

    // Enregistrement d'un nouvel équipement + Log
public function storeHardware(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'category_name' => 'required|string|max:255', // On récupère le texte saisi
            'status' => 'required|in:disponible,attribue,en_panne,reforme',
            'location' => 'required|string|max:255',
            'purchase_date' => 'nullable|date',
        ]);

        // 1. Chercher la catégorie ou la créer automatiquement si elle n'existe pas
        $category = Category::firstOrCreate(
            ['name' => trim($request->category_name)],
            ['type' => 'hardware']
        );

        // 2. Créer l'équipement
        $item = HardwareItem::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number ?? 'N/A-' . strtoupper(uniqid()),
            'category_id' => $category->id,
            'status' => $request->status,
            'location' => $request->location,
            'purchase_date' => $request->purchase_date,
        ]);

        // 3. Enregistrer le log de traçabilité
        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'ENTREE',
                'item_type' => 'Matériel',
                'item_name' => $item->name,
                'description' => 'Entrée en stock de "' . $item->name . '" (Catégorie: ' . $category->name . ')',
            ]);
        }

        return redirect()->route('admin.hardware.index')->with('success', 'Matériel ajouté et catégorie enregistrée avec succès.');
    }
    // Formulaire d'édition
    public function editHardware(HardwareItem $hardware)
    {
        $categories = Category::where('type', 'hardware')->get();
        return view('admin.hardware.edit', compact('hardware', 'categories'));
    }

    // Mise à jour de l'équipement + Log
    public function updateHardware(Request $request, HardwareItem $hardware)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:hardware_items,serial_number,' . $hardware->id,
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:disponible,attribue,en_panne,reforme',
            'location' => 'required|string|max:255',
            'purchase_date' => 'nullable|date',
        ]);

        $hardware->update($request->all());

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'MODIFICATION',
                'item_type' => 'Matériel',
                'item_name' => $hardware->name,
                'description' => 'Mise à jour des informations (Statut : ' . strtoupper($hardware->status) . ', Emplacement : ' . $hardware->location . ')',
            ]);
        }

        return redirect()->route('admin.hardware.index')->with('success', 'Équipement mis à jour avec succès.');
    }

    // Suppression du matériel + Log
    public function destroyHardware(HardwareItem $hardware)
    {
        $itemName = $hardware->name;
        $sn = $hardware->serial_number;

        $hardware->delete();

        if (class_exists(StockLog::class)) {
            StockLog::create([
                'user_id' => auth()->id(),
                'action' => 'SUPPRESSION',
                'item_type' => 'Matériel',
                'item_name' => $itemName,
                'description' => 'Retrait/Suppression définitive du matériel (S/N: ' . $sn . ')',
            ]);
        }

        return back()->with('success', 'Matériel supprimé du catalogue.');
    }
}